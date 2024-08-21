<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Tests;

use Monolog\Logger;
use Nesk\Puphpeteer\Puppeteer;
use Nesk\Puphpeteer\Resources\Browser;
use PHPUnit\Framework\{Constraint\Callback, TestCase as BaseTestCase};
use Psr\Log\LogLevel;
use ReflectionClass;
use ReflectionMethod;
use Symfony\Component\Process\Process;

abstract class TestCase extends BaseTestCase
{
    protected string $host = '127.0.0.1:8089';
    protected string $url = 'http://127.0.0.1:8089';
    protected string $serverDir = __DIR__ . '/resources';

    protected ?array $browserOptions = null;
    protected ?Browser $browser = null;
    protected Process $servingProcess;

    private array $dontPopulateProperties = [];

    public function setUp(): void
    {
        parent::setUp();

        $methodName = explode(' ', $this->name())[0] ?? '';
        $testMethod = new ReflectionMethod($this, $methodName);
        $docComment = $testMethod->getDocComment();

        if (!empty($docComment) && preg_match('/@dontPopulateProperties (.*)/', $docComment, $matches)) {
            $this->dontPopulateProperties = array_values(array_filter(explode(' ', $matches[1])));
        }
    }

    /**
     * Stops the browser and local server
     */
    public function tearDown(): void
    {
        // Close the browser.
        if (isset($this->browser)) {
            $this->browser->close();
        }

        // Shutdown the local server
        if (isset($this->servingProcess)) {
            $this->servingProcess->stop(0);
        }
    }

    /**
     * Serves the resources folder locally on port 8089
     */
    protected function serveResources(): void
    {
        // Spin up a local server to deliver the resources.
        $this->servingProcess = new Process(['php', '-S', $this->host, '-t', $this->serverDir]);
        $this->servingProcess->start();
    }

    /**
     * Launches the PuPHPeteer-controlled browser
     */
    protected function launchBrowser(): void
    {
        /**
         * Chrome does not support Linux sandbox on many CI environments
         *
         * @see: https://github.com/GoogleChrome/puppeteer/blob/master/docs/troubleshooting.md#chrome-headless-fails-due-to-sandbox-issues
         */
        $this->browserOptions = [
            'channel' => 'chrome',
            'headless' => 'new',
            'args' => ['--no-sandbox', '--disable-setuid-sandbox'],
        ];

        if ($this->canPopulateProperty('browser')) {
            $this->browser = (new Puppeteer())->launch($this->browserOptions);
        }
    }

    public function canPopulateProperty(string $propertyName): bool
    {
        return !in_array($propertyName, $this->dontPopulateProperties);
    }

    public function isLogLevel(): Callback
    {
        $psrLogLevels = (new ReflectionClass(LogLevel::class))->getConstants();
        $monologLevels = (new ReflectionClass(Logger::class))->getConstants();
        $monologLevels = array_intersect_key($monologLevels, $psrLogLevels);

        return $this->callback(function ($level) use ($psrLogLevels, $monologLevels) {
            if (is_string($level)) {
                return in_array($level, $psrLogLevels, true);
            } elseif (is_int($level)) {
                return in_array($level, $monologLevels, true);
            }

            return false;
        });
    }
}
