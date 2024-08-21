<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Rialto;

use Psr\Log\{LoggerInterface, LogLevel};
use ReflectionClass;
use RuntimeException;
use Socket\Raw\{Exception as SocketException, Factory as SocketFactory, Socket};
use Symfony\Component\Process\{Process as SymfonyProcess, Exception\ProcessFailedException};
use Nesk\Puphpeteer\Rialto\Exceptions\{
    IdleTimeoutException,
    ReadSocketTimeoutException,
    Node\Exception as NodeException,
    Node\FatalException as NodeFatalException,
};
use Nesk\Puphpeteer\Rialto\Interfaces\ShouldHandleProcessDelegation;

class ProcessSupervisor
{
    use Data\UnserializesData;
    use Traits\UsesBasicResourceAsDefault;

    /**
     * A reasonable delay to let the process terminate itself (in milliseconds).
     */
    protected const int PROCESS_TERMINATION_DELAY = 100;

    /**
     * The size of a packet sent through the sockets (in bytes).
     */
    protected const int SOCKET_PACKET_SIZE = 1024;

    /**
     * The size of the header in each packet sent through the sockets (in bytes).
     */
    protected const int SOCKET_HEADER_SIZE = 5;

    /**
     * A short period to wait before reading the next chunk (in milliseconds), this avoids the next chunk to be read as
     * an empty string when PuPHPeteer is running on a slow environment.
     */
    protected const int SOCKET_NEXT_CHUNK_DELAY = 1;

    /**
     * Options to remove before sending them for the process.
     *
     * @var string[]
     */
    protected const array USELESS_OPTIONS_FOR_PROCESS = [
        'executable_path',
        'read_timeout',
        'stop_timeout',
        'logger',
        'debug',
    ];

    /**
     * The associative array containing the options.
     */
    protected array $options = [
        // Node's executable path
        'executable_path' => 'node',

        // How much time (in seconds) the process can stay inactive before being killed (set to null to disable)
        'idle_timeout' => 60,

        // How much time (in seconds) an instruction can take to return a value (set to null to disable)
        'read_timeout' => 30,

        // How much time (in seconds) the process can take to shut down properly before being killed
        'stop_timeout' => 3,

        // A logger instance for debugging (must implement \Psr\Log\LoggerInterface)
        'logger' => null,

        // Logs the output of console methods (console.log, console.debug, console.table, etc...) to the PHP logger
        'log_node_console' => false,

        // Enables debugging mode:
        //   - adds the --inspect flag to Node command
        //   - appends stack traces to Node exception messages
        'debug' => false,
    ];

    /**
     * The running process.
     */
    protected SymfonyProcess $process;

    /**
     * The PID of the running process.
     */
    protected int $processPid;

    /**
     * The client to communicate with the process.
     */
    protected Socket $client;

    /**
     * The server port.
     */
    protected ?int $serverPort = null;

    /**
     * The logger instance.
     */
    protected LoggerInterface $logger;

    /**
     * Constructor.
     */
    public function __construct(
        string $connectionDelegatePath,
        /**
         * The process delegate.
         */
        private readonly ?ShouldHandleProcessDelegation $delegate = null,
        array $options = [],
    ) {
        $this->logger = new Logger($options['logger'] ?? null);

        $this->applyOptions($options);

        $this->process = $this->createNewProcess($connectionDelegatePath);

        $this->processPid = $this->startProcess($this->process);

        $this->client = $this->createNewClient($this->serverPort());

        if ($this->options['debug']) {
            // Clear error output made by the "--inspect" flag
            $this->process->clearErrorOutput();
        }
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        $logContext = ['pid' => $this->processPid];

        $this->waitForProcessTermination();

        if ($this->process->isRunning()) {
            $this->executeInstruction(Instruction::noop(), false); // Fetch the missing remote logs

            $this->logger->info('Stopping process with PID {pid}...', $logContext);
            $this->process->stop($this->options['stop_timeout']);
            $this->logger->info('Stopped process with PID {pid}', $logContext);
        } else {
            $this->logger->warning("The process cannot because be stopped because it's no longer running", $logContext);
        }
    }

    /**
     * Log data from the process standard streams.
     */
    protected function logProcessStandardStreams(): void
    {
        if (!empty(($output = $this->process->getIncrementalOutput()))) {
            $this->logger->notice('Received data on stdout: {output}', [
                'pid' => $this->processPid,
                'stream' => 'stdout',
                'output' => $output,
            ]);
        }

        if (!empty(($errorOutput = $this->process->getIncrementalErrorOutput()))) {
            $this->logger->error('Received data on stderr: {output}', [
                'pid' => $this->processPid,
                'stream' => 'stderr',
                'output' => $errorOutput,
            ]);
        }
    }

    /**
     * Apply the options.
     */
    protected function applyOptions(array $options): void
    {
        $this->logger->info('Applying options...', ['options' => $options]);

        $this->options = array_merge($this->options, $options);

        $this->logger->debug('Options applied and merged with defaults', ['options' => $this->options]);
    }

    /**
     * Return the script path of the Node process.
     *
     * In production, the script path must target the NPM package. In local development, the script path targets the
     * Composer package (since the NPM package is not installed).
     *
     * This avoids double declarations of some JS classes in production, due to a require with two different paths (one
     * with the NPM path, the other one with the Composer path).
     */
    protected function getProcessScriptPath(): string
    {
        static $scriptPath = null;

        if ($scriptPath !== null) {
            return $scriptPath;
        }

        // The script path in local development
        $scriptPath = __DIR__ . '/node-process/serve.mjs';

        $process = new SymfonyProcess([$this->options['executable_path'], '-e', $scriptPath]);
        $exitCode = $process->run();

        if ($exitCode === 0) {
            // The script path in production
            $scriptPath = $process->getOutput();
        }

        return $scriptPath;
    }

    /**
     * Create a new Node process.
     *
     * @throws RuntimeException if the path to the connection delegate cannot be found.
     */
    protected function createNewProcess(string $connectionDelegatePath): SymfonyProcess
    {
        $realConnectionDelegatePath = realpath($connectionDelegatePath);

        if ($realConnectionDelegatePath === false) {
            throw new RuntimeException("Cannot find file or directory '$connectionDelegatePath'.");
        }

        // Remove useless options for the process
        $processOptions = array_diff_key($this->options, array_flip(self::USELESS_OPTIONS_FOR_PROCESS));

        return new SymfonyProcess(
            array_merge(
                [$this->options['executable_path']],
                $this->options['debug'] ? ['--inspect'] : [],
                [$this->getProcessScriptPath()],
                [$realConnectionDelegatePath],
                [json_encode((object) $processOptions)],
            ),
        );
    }

    /**
     * Start the Node process.
     */
    protected function startProcess(SymfonyProcess $process): int
    {
        $this->logger->info('Starting process with command line: {commandline}', [
            'commandline' => $process->getCommandLine(),
        ]);

        $process->start();

        $pid = $process->getPid();

        $this->logger->info('Process started with PID {pid}', ['pid' => $pid]);

        return $pid;
    }

    /**
     * Check if the process is still running without errors.
     *
     * @throws ProcessFailedException
     */
    protected function checkProcessStatus(): void
    {
        $this->logProcessStandardStreams();

        $process = $this->process;

        if (!empty($process->getErrorOutput())) {
            if (IdleTimeoutException::exceptionApplies($process)) {
                throw new IdleTimeoutException(
                    $this->options['idle_timeout'],
                    new NodeFatalException($process, $this->options['debug']),
                );
            } elseif (NodeFatalException::exceptionApplies($process)) {
                throw new NodeFatalException($process, $this->options['debug']);
            } elseif ($process->isTerminated() && !$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
        }

        if ($process->isTerminated()) {
            throw new Exceptions\ProcessUnexpectedlyTerminatedException($process);
        }
    }

    /**
     * Wait for process termination.
     *
     * The process might take a while to stop itself. So, before trying to check its status or reading its standard
     * streams, this method should be executed.
     */
    protected function waitForProcessTermination(): void
    {
        usleep(self::PROCESS_TERMINATION_DELAY * 1000);
    }

    /**
     * Return the port of the server.
     */
    protected function serverPort(): int
    {
        if ($this->serverPort !== null) {
            return $this->serverPort;
        }

        $iterator = $this->process->getIterator(SymfonyProcess::ITER_SKIP_ERR | SymfonyProcess::ITER_KEEP_OUTPUT);

        foreach ($iterator as $data) {
            $this->serverPort = (int) $data;
            return $this->serverPort;
        }

        // The process must have failed if the iterator did not execute properly, but check to be sure.
        $this->checkProcessStatus();

        // Return serverPort if checkProcessStatus did not throw an exception
        return $this->serverPort;
    }

    /**
     * Create a new client to communicate with the process.
     */
    protected function createNewClient(int $port): Socket
    {
        // Set the client as non-blocking to handle the exceptions thrown by the process
        return (new SocketFactory())->createClient("tcp://127.0.0.1:$port")->setBlocking(false);
    }

    /**
     * Send an instruction to the process for execution.
     */
    public function executeInstruction(Instruction $instruction, bool $instructionShouldBeLogged = true)
    {
        // Check the process status because it could have crash in idle status.
        $this->checkProcessStatus();

        $serializedInstruction = json_encode($instruction);

        if ($instructionShouldBeLogged) {
            $this->logger->debug('Sending an instruction to the port {port}...', [
                'pid' => $this->processPid,
                'port' => $this->serverPort(),

                // The instruction must be fully encoded and decoded to appear properly in the logs (this way,
                // JS functions and resources are serialized too).
                'instruction' => json_decode($serializedInstruction, true),
            ]);
        }

        $this->client->selectWrite(1);

        $packet = $serializedInstruction . chr(0);
        $packetSentByteCount = 0;
        while ($packetSentByteCount < strlen($packet)) {
            $packetSentByteCount += $this->client->write(substr($packet, $packetSentByteCount));
        }

        $value = $this->readNextProcessValue($instructionShouldBeLogged);

        // Check the process status if the value is null because, if the process crash while executing the instruction,
        // the socket closes and returns an empty value (which is converted to `null`).
        if ($value === null) {
            $this->checkProcessStatus();
        }

        return $value;
    }

    /**
     * Read the next value written by the process.
     *
     * @throws ReadSocketTimeoutException if reading the socket exceeded the timeout.
     * @throws NodeException if the process returned an error.
     */
    protected function readNextProcessValue(bool $valueShouldBeLogged = true)
    {
        $readTimeout = $this->options['read_timeout'];
        $payload = '';

        try {
            $startTimestamp = microtime(true);

            do {
                $this->client->selectRead($readTimeout);
                $packet = $this->client->read(static::SOCKET_PACKET_SIZE);

                $chunksLeft = (int) substr($packet, 0, static::SOCKET_HEADER_SIZE);
                $chunk = substr($packet, static::SOCKET_HEADER_SIZE);

                $payload .= $chunk;

                if ($chunksLeft > 0) {
                    // The next chunk might be an empty string on slow environments without a short pause.
                    usleep(self::SOCKET_NEXT_CHUNK_DELAY * 1000);
                }
            } while ($chunksLeft > 0);
        } catch (SocketException $exception) {
            $this->waitForProcessTermination();
            $this->checkProcessStatus();

            // Extract the socket error code to throw more specific exceptions
            preg_match('/\(([A-Z_]+?)\)$/', $exception->getMessage(), $socketErrorMatches);
            $socketErrorCode = constant($socketErrorMatches[1]);

            $elapsedTime = microtime(true) - $startTimestamp;
            if ($socketErrorCode === SOCKET_EAGAIN && $readTimeout !== null && $elapsedTime >= $readTimeout) {
                throw new ReadSocketTimeoutException($readTimeout, $exception);
            }

            throw $exception;
        }

        $this->logProcessStandardStreams();

        ['logs' => $logs, 'value' => $value] = json_decode(base64_decode($payload), true);

        foreach ($logs ?: [] as $log) {
            $level = (new ReflectionClass(LogLevel::class))->getConstant($log['level']);
            $messageContainsLineBreaks = str_contains($log['message'], PHP_EOL);
            $formattedMessage = $messageContainsLineBreaks ? "\n{log}\n" : '{log}';

            $this->logger->log($level, "Received a $log[origin] log: $formattedMessage", [
                'pid' => $this->processPid,
                'port' => $this->serverPort(),
                'log' => $log['message'],
            ]);
        }

        $value = $this->unserialize($value);

        if ($valueShouldBeLogged) {
            $this->logger->debug('Received data from the port {port}...', [
                'pid' => $this->processPid,
                'port' => $this->serverPort(),
                'data' => $value,
            ]);
        }

        if ($value instanceof NodeException) {
            throw $value;
        }

        return $value;
    }
}
