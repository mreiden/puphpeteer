<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Tests;

use Generator;
use Nesk\Puphpeteer\{Puppeteer, Resources\ElementHandle};
use Nesk\Puphpeteer\Rialto\Data\JsFunction;
use PHPUnit\Framework\{Attributes\DataProvider, Attributes\Test, ExpectationFailedException};
use Psr\Log\LoggerInterface;

class PuphpeteerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // Serve the content of the "/resources"-folder to test these.
        $this->serveResources();

        // Launch the browser to run tests on.
        $this->launchBrowser();
    }

    #[Test]
    public function can_browse_website()
    {
        $response = $this->browser->newPage()->goto($this->url);

        $this->assertTrue($response->ok(), 'Failed asserting that the response is successful.');
    }

    #[Test]
    public function can_use_method_aliases()
    {
        $page = $this->browser->newPage();

        $page->goto($this->url);

        $select = function ($resource) {
            $elements = [
                $resource->querySelector('h1'),
                $resource->querySelectorAll('h1')[0],
                $resource->querySelectorXPath('/html/body/h1')[0],
            ];

            $this->assertContainsOnlyInstancesOf(ElementHandle::class, $elements);
        };

        $evaluate = function ($resource) {
            $strings = [
                $resource->querySelectorEval('h1', (new JsFunction())->body('return "Hello World!";')),
                $resource->querySelectorAllEval('h1', (new JsFunction())->body('return "Hello World!";')),
            ];

            foreach ($strings as $string) {
                $this->assertEquals('Hello World!', $string);
            }
        };

        // Test method aliases for Page, Frame and ElementHandle classes
        $resources = [$page, $page->mainFrame(), $page->querySelector('body')];
        foreach ($resources as $resource) {
            $select($resource);
            $evaluate($resource);
        }
    }

    #[Test]
    public function can_evaluate_a_selection()
    {
        $page = $this->browser->newPage();

        $page->goto($this->url);

        $title = $page->querySelectorEval(
            'h1',
            (new JsFunction())->parameters(['node'])->body('return node.textContent;'),
        );

        $titleCount = $page->querySelectorAllEval(
            'h1',
            (new JsFunction())->parameters(['nodes'])->body('return nodes.length;'),
        );

        $this->assertEquals('Example Page', $title);
        $this->assertEquals(1, $titleCount);
    }

    #[Test]
    public function can_intercept_requests()
    {
        $page = $this->browser->newPage();

        $page->setRequestInterception(true);
        $page->on(
            'request',
            (new JsFunction())
                ->parameters(['request'])
                ->body('request.resourceType() === "stylesheet" ? request.abort() : request.continue()'),
        );

        $page->goto($this->url);

        $backgroundColor = $page->querySelectorEval(
            'h1',
            (new JsFunction())->parameters(['node'])->body('return getComputedStyle(node).textTransform'),
        );

        $this->assertNotEquals('lowercase', $backgroundColor);
    }

    /**
     * @dontPopulateProperties browser
     */
    #[Test]
    #[DataProvider('resourceProvider')]
    public function check_all_resources_are_supported(string $name)
    {
        $incompleteTest = false;
        $resourceInstantiator = new ResourceInstantiator($this->browserOptions, $this->url);
        $resource = $resourceInstantiator->{$name}(new Puppeteer(), $this->browserOptions);

        if ($resource instanceof UntestableResource) {
            $incompleteTest = true;
        } elseif ($resource instanceof RiskyResource) {
            if (!empty($resource->exception())) {
                $incompleteTest = true;
            } else {
                try {
                    $this->assertInstanceOf("Nesk\\Puphpeteer\\Resources\\$name", $resource->value());
                } catch (ExpectationFailedException) {
                    $incompleteTest = true;
                }
            }
        } else {
            $this->assertInstanceOf("Nesk\\Puphpeteer\\Resources\\$name", $resource);
        }

        if (!$incompleteTest) {
            return;
        }

        $reason =
            "The \"$name\" resource has not been tested properly, probably" .
            " for a good reason but you might want to have a look: \n\n    ";

        if ($resource instanceof UntestableResource) {
            $reason .= "\e[33mMarked as untestable.\e[0m";
        } elseif (!empty(($exception = $resource->exception()))) {
            $reason .= "\e[31mMarked as risky because of a Node error: {$exception->getMessage()}\e[0m";
        } else {
            $value = print_r($resource->value(), true);
            $reason .= "\e[31mMarked as risky because of an unexpected value: $value\e[0m";
        }

        $this->markTestIncomplete($reason);
    }

    public static function resourceProvider(): Generator
    {
        $resourceNames = (new ResourceInstantiator([], ''))->getResourceNames();
        foreach ($resourceNames as $name) {
            yield [$name];
        }
    }

    private function createBrowserLogger(callable $onBrowserLog): LoggerInterface
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger
            ->expects(self::atLeastOnce())
            ->method('log')
            ->willReturnCallback(function (string $level, string $message) use ($onBrowserLog) {
                if (str_starts_with($message, 'Received a Browser log:')) {
                    $onBrowserLog();
                }

                return null;
            });

        return $logger;
    }

    /**
     * @dontPopulateProperties browser
     */
    #[Test]
    public function browser_console_calls_are_logged_if_enabled()
    {
        $browserLogOccurred = false;
        $logger = $this->createBrowserLogger(function () use (&$browserLogOccurred) {
            $browserLogOccurred = true;
        });

        $puppeteer = new Puppeteer([
            'log_browser_console' => true,
            'logger' => $logger,
        ]);

        $this->browser = $puppeteer->launch($this->browserOptions);
        $this->browser->pages()[0]->goto($this->url);

        static::assertTrue($browserLogOccurred);
    }

    /**
     * @dontPopulateProperties browser
     */
    #[Test]
    public function browser_console_calls_are_not_logged_if_disabled()
    {
        $browserLogOccurred = false;
        $logger = $this->createBrowserLogger(function () use (&$browserLogOccurred) {
            $browserLogOccurred = true;
        });

        $puppeteer = new Puppeteer([
            'log_browser_console' => false,
            'logger' => $logger,
        ]);

        $this->browser = $puppeteer->launch($this->browserOptions);
        $this->browser->pages()[0]->goto($this->url);

        static::assertFalse($browserLogOccurred);
    }
}
