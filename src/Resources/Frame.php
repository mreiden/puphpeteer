<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Traits\{AliasesEvaluationMethods, AliasesSelectionMethods};
use Nesk\Puphpeteer\Rialto\Data\{BasicResource, JsFunction};

/**
 * @method bool isOOPFrame()
 *
 * @method-extended bool isOOPFrame()
 *
 * @method HTTPResponse|null goto(string $url, array $options = [])
 *
 * @method-extended HTTPResponse|null goto(string $url, array{ referer: string, timeout: float, waitUntil: string|string[] } $options = null)
 *
 * @method HTTPResponse|null waitForNavigation(array $options = [])
 *
 * @method-extended HTTPResponse|null waitForNavigation(array{ timeout: float, waitUntil: string|string[] } $options = null)
 *
 * @method mixed evaluateHandle(JsFunction|string $pageFunction, int|float|string|bool|array|JSHandle|null ...$args)
 *
 * @method-extended mixed evaluateHandle(JsFunction|callable|string $pageFunction, int|float|string|bool|null|array|JSHandle ...$args)
 *
 * @method mixed evaluate(JsFunction $pageFunction, int|float|string|bool|array|JSHandle|null ...$args)
 *
 * @method-extended mixed evaluate(callable|JsFunction $pageFunction, int|float|string|bool|null|array|JSHandle ...$args)
 *
 * @method string content()
 *
 * @method-extended string content()
 *
 * @method void setContent(string $html, array $options = [])
 *
 * @method-extended void setContent(string $html, array{ timeout: float, waitUntil: string|string[] } $options = null)
 *
 * @method string name()
 *
 * @method-extended string name()
 *
 * @method string url()
 *
 * @method-extended string url()
 *
 * @method Frame|null parentFrame()
 *
 * @method-extended Frame|null parentFrame()
 *
 * @method Frame[] childFrames()
 *
 * @method-extended Frame[] childFrames()
 *
 * @method bool isDetached()
 *
 * @method-extended bool isDetached()
 *
 * @method ElementHandle addScriptTag(array $options)
 *
 * @method-extended ElementHandle addScriptTag(array<string, mixed> $options)
 *
 * @method ElementHandle addStyleTag(array $options)
 *
 * @method-extended ElementHandle addStyleTag(array<string, mixed> $options)
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
 * @method JSHandle|null waitFor(string|float|JsFunction $selectorOrFunctionOrTimeout, array|string[]|mixed[] $options = null, int|float|string|bool|null|array|JSHandle ...$args)
 *
 * @method-extended JSHandle|null waitFor(string|float|callable|JsFunction $selectorOrFunctionOrTimeout, array|string[]|mixed[] $options = null, int|float|string|bool|null|array|JSHandle ...$args)
 *
 * @method void waitForTimeout(float $milliseconds)
 *
 * @method-extended void waitForTimeout(float $milliseconds)
 *
 * @method ElementHandle|null waitForSelector(string $selector, array $options = [])
 *
 * @method-extended ElementHandle|null waitForSelector(string $selector, array<string, mixed> $options = null)
 *
 * @method ElementHandle|null waitForXPath(string $xpath, array $options = [])
 *
 * @method-extended ElementHandle|null waitForXPath(string $xpath, array<string, mixed> $options = null)
 *
 * @method JSHandle waitForFunction(JsFunction|string $pageFunction, array $options = [], int|float|string|bool|null|array|JSHandle ...$args)
 *
 * @method-extended JSHandle waitForFunction(callable|JsFunction|string $pageFunction, array<string, mixed> $options = null, int|float|string|bool|null|array|JSHandle ...$args)
 *
 * @method string title()
 *
 * @method-extended string title()
 */
class Frame extends BasicResource
{
    use AliasesEvaluationMethods;
    use AliasesSelectionMethods;
}
