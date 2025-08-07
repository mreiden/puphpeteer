<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer;

use Composer\Semver\Semver;
use Nesk\Puphpeteer\Resources\Browser;
use Nesk\Puphpeteer\Rialto\AbstractEntryPoint;
use Psr\Log\LoggerInterface;
use Symfony\Component\Process\Process;

/**
 * @property string $defaultBrowserRevision
 * @property mixed $configuration
 * @property-read string $browserVersion
 * @property-read string|null $defaultDownloadPath
 * @property-read mixed $lastLaunchedBrowser
 * @property-read mixed $defaultBrowser
 * @property-read string $product
 * @method Resources\Browser connect(array $options)
 * @method-extended Resources\Browser connect(array<string, mixed> $options)
 * @method Resources\Browser launch(array $options = [])
 * @method-extended Resources\Browser launch(array<string, mixed> $options = null)
 * @method string executablePath()
 * @method-extended string executablePath()
 * @method string[] defaultArgs(array $options = [])
 * @method-extended string[] defaultArgs(array<string, mixed> $options = null)
 * @method void trimCache()
 * @method-extended void trimCache()
 */
class Puppeteer extends AbstractEntryPoint
{
    /**
     * Default options.
     */
    protected array $options = [
        'read_timeout' => 30,

        // Logs the output of Browser's console methods (console.log, console.debug, etc...) to the PHP logger
        'log_browser_console' => false,

        // Custom js to load puppeteer-extra plugins
        'js_extra' => '',
    ];

    /**
     * Instantiate Puppeteer's entry point.
     */
    public function __construct(array $userOptions = [])
    {
        if (!empty($userOptions['logger']) && $userOptions['logger'] instanceof LoggerInterface) {
            $this->checkPuppeteerVersion($userOptions['executable_path'] ?? 'node', $userOptions['logger']);
        }

        parent::__construct(
            new PuppeteerProcessDelegate(),
            $this->options,
            $userOptions,
        );
    }

    private function checkPuppeteerVersion(string $nodePath, LoggerInterface $logger): void
    {
        $currentVersion = $this->currentPuppeteerVersion($nodePath);
        $acceptedVersions = $this->acceptedPuppeteerVersion();

        if (null === $currentVersion) {
            $logger->warning("Puppeteer doesn't seem to be installed.");
        } elseif (!Semver::satisfies($currentVersion, $acceptedVersions)) {
            $logger->warning(
                "The installed version of Puppeteer (v$currentVersion) doesn't match the requirements" .
                    " ($acceptedVersions), you may encounter issues.",
            );
        }
    }

    private function currentPuppeteerVersion(string $nodePath): ?string
    {
        $process = new Process([$nodePath, __DIR__ . '/get-puppeteer-version.mjs']);
        $process->mustRun();

        return json_decode($process->getOutput(), true, 10, JSON_THROW_ON_ERROR);
    }

    private function acceptedPuppeteerVersion(): string
    {
        $npmManifestPath = __DIR__ . '/../package.json';
        $contents = file_get_contents($npmManifestPath) ?: throw new \Exception('Cant load file');
        $npmManifest = json_decode($contents, false, 10, JSON_THROW_ON_ERROR);

        return $npmManifest->dependencies->{"puppeteer-core"};
    }
}
