<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Tests;

use Nesk\Puphpeteer\Rialto\Data\JsFunction;
use Nesk\Puphpeteer\Puppeteer;
use Nesk\Puphpeteer\Resources\{Browser, Frame, HTTPResponse, Page};

/**
 * ResourceInstantiator
 *
 * @method Page Page(Puppeteer $puppeteer)
 * @method Browser Browser(Puppeteer $puppeteer)
 * @method Frame Frame(Puppeteer $puppeteer)
 * @method HTTPResponse HttpResponse(Puppeteer $puppeteer)
 */
final class ResourceInstantiator
{
    protected $resources = [];

    public function __construct(public array $browserOptions, public string $url)
    {
        $this->resources = [
            'Accessibility' => fn(Puppeteer $puppeteer) => $this->Page($puppeteer)->accessibility,
            'Browser' => fn(Puppeteer $puppeteer) => $puppeteer->launch($this->browserOptions),
            /**
             * Puppeteer v22.0.0 renamed createIncognitoBrowserContext to createBrowserContext
             * (@see https://github.com/puppeteer/puppeteer/issues/11834)
             */
            'BrowserContext' => fn(Puppeteer $puppeteer) => $this->Browser($puppeteer)->createBrowserContext(),
            'CDPSession' => fn(Puppeteer $puppeteer) => $this->Target($puppeteer)->createCDPSession(),
            'ConsoleMessage' => fn() => new UntestableResource(),
            'Coverage' => fn(Puppeteer $puppeteer) => $this->Page($puppeteer)->coverage,
            'Dialog' => fn() => new UntestableResource(),
            'ElementHandle' => fn(Puppeteer $puppeteer) => $this->Page($puppeteer)->querySelector('body'),
            'EventEmitter' => fn(Puppeteer $puppeteer) => $puppeteer->launch($this->browserOptions),
            /**
             * Puppeteer v17.0.0 removed ExecutionContext (@see https://github.com/puppeteer/puppeteer/pull/8844)
             *
             * //'ExecutionContext' => fn(Puppeteer $puppeteer) => $this->Frame($puppeteer)->executionContext(),
             */
            'FileChooser' => fn() => new UntestableResource(),
            'Frame' => fn(Puppeteer $puppeteer) => $this->Page($puppeteer)->mainFrame(),
            'HTTPRequest' => fn(Puppeteer $puppeteer) => $this->HTTPResponse($puppeteer)->request(),
            'HTTPResponse' => fn(Puppeteer $puppeteer) => $this->Page($puppeteer)->goto($this->url),
            'JSHandle' => fn(Puppeteer $puppeteer) => $this->Page($puppeteer)->evaluateHandle(
                new JsFunction()->body('window'),
            ),
            'Keyboard' => fn(Puppeteer $puppeteer) => $this->Page($puppeteer)->keyboard,
            'Mouse' => fn(Puppeteer $puppeteer) => $this->Page($puppeteer)->mouse,
            'Page' => fn(Puppeteer $puppeteer) => $this->Browser($puppeteer)->newPage(),
            'SecurityDetails' => fn(Puppeteer $puppeteer) => new RiskyResource(
                fn() => $this->Page($puppeteer)->goto('https://example.com/')->securityDetails(),
            ),
            'Target' => fn(Puppeteer $puppeteer) => $this->Page($puppeteer)->target(),
            'TimeoutError' => fn() => new UntestableResource(),
            'Touchscreen' => fn(Puppeteer $puppeteer) => $this->Page($puppeteer)->touchscreen,
            'Tracing' => fn(Puppeteer $puppeteer) => $this->Page($puppeteer)->tracing,
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
