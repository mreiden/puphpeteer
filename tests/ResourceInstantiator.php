<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Tests;

use Nesk\Puphpeteer\Rialto\Data\JsFunction;

final class ResourceInstantiator
{
    protected $resources = [];

    public function __construct(public array $browserOptions, public string $url)
    {
        $this->resources = [
            'Accessibility' => fn($puppeteer) => $this->Page($puppeteer)->accessibility,
            'Browser' => fn($puppeteer) => $puppeteer->launch($this->browserOptions),
            /**
             * Puppeteer v22.0.0 renamed createIncognitoBrowserContext to createBrowserContext
             * (@see https://github.com/puppeteer/puppeteer/issues/11834)
             */
            'BrowserContext' => fn($puppeteer) => $this->Browser($puppeteer)->createBrowserContext(),
            'CDPSession' => fn($puppeteer) => $this->Target($puppeteer)->createCDPSession(),
            'ConsoleMessage' => fn() => new UntestableResource(),
            'Coverage' => fn($puppeteer) => $this->Page($puppeteer)->coverage,
            'Dialog' => fn() => new UntestableResource(),
            'ElementHandle' => fn($puppeteer) => $this->Page($puppeteer)->querySelector('body'),
            'EventEmitter' => fn($puppeteer) => $puppeteer->launch($this->browserOptions),
            /**
             * Puppeteer v17.0.0 removed ExecutionContext (@see https://github.com/puppeteer/puppeteer/pull/8844)
             *
             * //'ExecutionContext' => fn($puppeteer) => $this->Frame($puppeteer)->executionContext(),
             */
            'FileChooser' => fn() => new UntestableResource(),
            'Frame' => fn($puppeteer) => $this->Page($puppeteer)->mainFrame(),
            'HTTPRequest' => fn($puppeteer) => $this->HTTPResponse($puppeteer)->request(),
            'HTTPResponse' => fn($puppeteer) => $this->Page($puppeteer)->goto($this->url),
            'JSHandle' => fn($puppeteer) => $this->Page($puppeteer)->evaluateHandle((new JsFunction())->body('window')),
            'Keyboard' => fn($puppeteer) => $this->Page($puppeteer)->keyboard,
            'Mouse' => fn($puppeteer) => $this->Page($puppeteer)->mouse,
            'Page' => fn($puppeteer) => $this->Browser($puppeteer)->newPage(),
            'SecurityDetails' => fn($puppeteer) => new RiskyResource(
                fn() => $this->Page($puppeteer)->goto('https://example.com/')->securityDetails(),
            ),
            'Target' => fn($puppeteer) => $this->Page($puppeteer)->target(),
            'TimeoutError' => fn() => new UntestableResource(),
            'Touchscreen' => fn($puppeteer) => $this->Page($puppeteer)->touchscreen,
            'Tracing' => fn($puppeteer) => $this->Page($puppeteer)->tracing,
            'WebWorker' => function ($puppeteer) {
                $page = $this->Page($puppeteer);
                $page->goto($this->url, ['waitUntil' => 'networkidle0']);
                return $page->workers()[0];
            },
        ];
    }

    public function getResourceNames(): array
    {
        return array_keys($this->resources);
    }

    public function __call(string $name, array $arguments)
    {
        if (!isset($this->resources[$name])) {
            throw new \InvalidArgumentException("The $name resource is not supported.");
        }

        return $this->resources[$name](...$arguments);
    }
}
