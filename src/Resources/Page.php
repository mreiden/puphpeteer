<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Traits\{AliasesEvaluationMethods, AliasesSelectionMethods};
use Nesk\Puphpeteer\Rialto\Data\JsFunction;

/**
 * @property Keyboard keyboard
 * @property Touchscreen touchscreen
 * @property Coverage coverage
 * @property Tracing tracing
 * @property Accessibility accessibility
 * @property Mouse mouse
 *
 * @method bool isDragInterceptionEnabled()
 *
 * @method-extended bool isDragInterceptionEnabled()
 *
 * @method bool isJavaScriptEnabled()
 *
 * @method-extended bool isJavaScriptEnabled()
 *
 * @method EventEmitter on(mixed $eventName, JsFunction $handler)
 *
 * @method-extended EventEmitter on(mixed $eventName, callable(mixed $event): void|JsFunction $handler)
 *
 * @method EventEmitter once(mixed $eventName, JsFunction $handler)
 *
 * @method-extended EventEmitter once(mixed $eventName, callable(mixed $event): void|JsFunction $handler)
 *
 * @method EventEmitter off(mixed $eventName, JsFunction $handler)
 *
 * @method-extended EventEmitter off(mixed $eventName, callable(mixed $event): void|JsFunction $handler)
 *
 * @method FileChooser waitForFileChooser(array $options = [])
 *
 * @method-extended FileChooser waitForFileChooser(array<string, mixed> $options = null)
 *
 * @method void setGeolocation(array $options)
 *
 * @method-extended void setGeolocation(array<string, mixed> $options)
 *
 * @method Target target()
 *
 * @method-extended Target target()
 *
 * @method Browser browser()
 *
 * @method-extended Browser browser()
 *
 * @method BrowserContext browserContext()
 *
 * @method-extended BrowserContext browserContext()
 *
 * @method Frame mainFrame()
 *
 * @method-extended Frame mainFrame()
 *
 * @method Frame[] frames()
 *
 * @method-extended Frame[] frames()
 *
 * @method WebWorker[] workers()
 *
 * @method-extended WebWorker[] workers()
 *
 * @method void setRequestInterception(bool $value)
 *
 * @method-extended void setRequestInterception(bool $value)
 *
 * @method void setDragInterception(bool $enabled)
 *
 * @method-extended void setDragInterception(bool $enabled)
 *
 * @method void setOfflineMode(bool $enabled)
 *
 * @method-extended void setOfflineMode(bool $enabled)
 *
 * @method void emulateNetworkConditions(mixed|null $networkConditions)
 *
 * @method-extended void emulateNetworkConditions(mixed|null $networkConditions)
 *
 * @method void setDefaultNavigationTimeout(float $timeout)
 *
 * @method-extended void setDefaultNavigationTimeout(float $timeout)
 *
 * @method void setDefaultTimeout(float $timeout)
 *
 * @method-extended void setDefaultTimeout(float $timeout)
 *
 * @method mixed evaluateHandle(JsFunction|string $pageFunction, int|float|string|bool|array|JSHandle|null ...$args)
 *
 * @method-extended mixed evaluateHandle(JsFunction|callable|string $pageFunction, int|float|string|bool|null|array|JSHandle ...$args)
 *
 * @method JSHandle queryObjects(JSHandle $prototypeHandle)
 *
 * @method-extended JSHandle queryObjects(JSHandle $prototypeHandle)
 *
 * @method mixed[] cookies(string ...$urls)
 *
 * @method-extended mixed[] cookies(string ...$urls)
 *
 * @method void deleteCookie(mixed ...$cookies)
 *
 * @method-extended void deleteCookie(mixed ...$cookies)
 *
 * @method void setCookie(mixed ...$cookies)
 *
 * @method-extended void setCookie(mixed ...$cookies)
 *
 * @method ElementHandle addScriptTag(array $options)
 *
 * @method-extended ElementHandle addScriptTag(array{ url: string, path: string, content: string, type: string, id: string } $options)
 *
 * @method ElementHandle addStyleTag(array $options)
 *
 * @method-extended ElementHandle addStyleTag(array{ url: string, path: string, content: string } $options)
 *
 * @method void exposeFunction(string $name, JsFunction|array $puppeteerFunction)
 *
 * @method-extended void exposeFunction(string $name, callable|JsFunction|array{ default: callable|JsFunction } $puppeteerFunction)
 *
 * @method void authenticate(mixed $credentials)
 *
 * @method-extended void authenticate(mixed $credentials)
 *
 * @method void setExtraHTTPHeaders(array|string[]|string[] $headers)
 *
 * @method-extended void setExtraHTTPHeaders(array|string[]|string[] $headers)
 *
 * @method void setUserAgent(string $userAgent, mixed $userAgentMetadata = null)
 *
 * @method-extended void setUserAgent(string $userAgent, mixed $userAgentMetadata = null)
 *
 * @method mixed metrics()
 *
 * @method-extended mixed metrics()
 *
 * @method string url()
 *
 * @method-extended string url()
 *
 * @method string content()
 *
 * @method-extended string content()
 *
 * @method void setContent(string $html, array $options = [])
 *
 * @method-extended void setContent(string $html, array<string, mixed> $options = null)
 *
 * @method HTTPResponse|null goto(string $url, array $options = [])
 *
 * @method-extended HTTPResponse|null goto(string $url, array<string, mixed>&array{ referer: string } $options = null)
 *
 * @method HTTPResponse|null reload(array $options = [])
 *
 * @method-extended HTTPResponse|null reload(array<string, mixed> $options = null)
 *
 * @method HTTPResponse|null waitForNavigation(array $options = [])
 *
 * @method-extended HTTPResponse|null waitForNavigation(array<string, mixed> $options = null)
 *
 * @method HTTPRequest waitForRequest(string|JsFunction $urlOrPredicate, array $options = [])
 *
 * @method-extended HTTPRequest waitForRequest(string|callable(callable(HTTPRequest $req): bool|Promise|bool[]|JsFunction): |JsFunction $urlOrPredicate, array{ timeout: float } $options = null)
 *
 * @method HTTPResponse waitForResponse(string|JsFunction $urlOrPredicate, array $options = [])
 *
 * @method-extended HTTPResponse waitForResponse(string|callable(callable(HTTPResponse $res): bool|Promise|bool[]|JsFunction): |JsFunction $urlOrPredicate, array{ timeout: float } $options = null)
 *
 * @method void waitForNetworkIdle(array $options = [])
 *
 * @method-extended void waitForNetworkIdle(array{ idleTime: float, timeout: float } $options = null)
 *
 * @method Frame waitForFrame(string|JsFunction $urlOrPredicate, array $options = [])
 *
 * @method-extended Frame waitForFrame(string|callable(callable(Frame $frame): bool|Promise|bool[]|JsFunction): |JsFunction $urlOrPredicate, array{ timeout: float } $options = null)
 *
 * @method HTTPResponse|null goBack(array $options = [])
 *
 * @method-extended HTTPResponse|null goBack(array<string, mixed> $options = null)
 *
 * @method HTTPResponse|null goForward(array $options = [])
 *
 * @method-extended HTTPResponse|null goForward(array<string, mixed> $options = null)
 *
 * @method void bringToFront()
 *
 * @method-extended void bringToFront()
 *
 * @method void emulate(array $options)
 *
 * @method-extended void emulate(array{ viewport: mixed, userAgent: string } $options)
 *
 * @method void setJavaScriptEnabled(bool $enabled)
 *
 * @method-extended void setJavaScriptEnabled(bool $enabled)
 *
 * @method void setBypassCSP(bool $enabled)
 *
 * @method-extended void setBypassCSP(bool $enabled)
 *
 * @method void emulateMediaType(string $type = null)
 *
 * @method-extended void emulateMediaType(string $type = null)
 *
 * @method void emulateCPUThrottling(float|null $factor)
 *
 * @method-extended void emulateCPUThrottling(float|null $factor)
 *
 * @method void emulateMediaFeatures(mixed[] $features = null)
 *
 * @method-extended void emulateMediaFeatures(mixed[] $features = null)
 *
 * @method void emulateTimezone(string $timezoneId = null)
 *
 * @method-extended void emulateTimezone(string $timezoneId = null)
 *
 * @method void emulateIdleState(array $overrides = [])
 *
 * @method-extended void emulateIdleState(array{ isUserActive: bool, isScreenUnlocked: bool } $overrides = null)
 *
 * @method void emulateVisionDeficiency(mixed $type = null)
 *
 * @method-extended void emulateVisionDeficiency(mixed $type = null)
 *
 * @method void setViewport(mixed $viewport)
 *
 * @method-extended void setViewport(mixed $viewport)
 *
 * @method mixed|null viewport()
 *
 * @method-extended mixed|null viewport()
 *
 * @method mixed evaluate(JsFunction $pageFunction, int|float|string|bool|array|JSHandle|null ...$args)
 *
 * @method-extended mixed evaluate(callable|JsFunction $pageFunction, int|float|string|bool|null|array|JSHandle ...$args)
 *
 * @method void evaluateOnNewDocument(JsFunction|string $pageFunction, mixed ...$args)
 *
 * @method-extended void evaluateOnNewDocument(callable|JsFunction|string $pageFunction, mixed ...$args)
 *
 * @method void setCacheEnabled(bool $enabled = null)
 *
 * @method-extended void setCacheEnabled(bool $enabled = null)
 *
 * @method mixed|string screenshot(array $options = [])
 *
 * @method-extended mixed|string screenshot(array<string, mixed> $options = null)
 *
 * @method mixed createPDFStream(array $options = [])
 *
 * @method-extended mixed createPDFStream(array<string, mixed> $options = null)
 *
 * @method mixed pdf(array $options = [])
 *
 * @method-extended mixed pdf(array<string, mixed> $options = null)
 *
 * @method string title()
 *
 * @method-extended string title()
 *
 * @method void close(array $options = [])
 *
 * @method-extended void close(array{ runBeforeUnload: bool } $options = null)
 *
 * @method bool isClosed()
 *
 * @method-extended bool isClosed()
 *
 * @method void click(string $selector, array $options = [])
 *
 * @method-extended void click(string $selector, array{ delay: float, button: mixed, clickCount: float } $options = null)
 *
 * @method void focus(string $selector)
 *
 * @method-extended void focus(string $selector)
 *
 * @method void hover(string $selector)
 *
 * @method-extended void hover(string $selector)
 *
 * @method string[] select(string $selector, string ...$values)
 *
 * @method-extended string[] select(string $selector, string ...$values)
 *
 * @method void tap(string $selector)
 *
 * @method-extended void tap(string $selector)
 *
 * @method void type(string $selector, string $text, array $options = [])
 *
 * @method-extended void type(string $selector, string $text, array{ delay: float } $options = null)
 *
 * @method JSHandle|null waitFor(string|float|JsFunction $selectorOrFunctionOrTimeout, array $options = [], int|float|string|bool|null|array|JSHandle ...$args)
 *
 * @method-extended JSHandle|null waitFor(string|float|callable|JsFunction $selectorOrFunctionOrTimeout, array{ visible: bool, hidden: bool, timeout: float, polling: string|float } $options = null, int|float|string|bool|null|array|JSHandle ...$args)
 *
 * @method void waitForTimeout(float $milliseconds)
 *
 * @method-extended void waitForTimeout(float $milliseconds)
 *
 * @method ElementHandle|null waitForSelector(string $selector, array $options = [])
 *
 * @method-extended ElementHandle|null waitForSelector(string $selector, array{ visible: bool, hidden: bool, timeout: float } $options = null)
 *
 * @method ElementHandle|null waitForXPath(string $xpath, array $options = [])
 *
 * @method-extended ElementHandle|null waitForXPath(string $xpath, array{ visible: bool, hidden: bool, timeout: float } $options = null)
 *
 * @method JSHandle waitForFunction(JsFunction|string $pageFunction, array $options = [], int|float|string|bool|null|array|JSHandle ...$args)
 *
 * @method-extended JSHandle waitForFunction(callable|JsFunction|string $pageFunction, array{ timeout: float, polling: string|float } $options = null, int|float|string|bool|null|array|JSHandle ...$args)
 */
class Page extends EventEmitter
{
    use AliasesEvaluationMethods;
    use AliasesSelectionMethods;
}
