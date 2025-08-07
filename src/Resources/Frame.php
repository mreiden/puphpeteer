<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Traits\{AliasesEvaluationMethods, AliasesSelectionMethods};
use Nesk\Puphpeteer\Rialto\Data\BasicResource;

/**
 * @property-read CDPSession $client
 * @property-read Accessibility $accessibility
 * @property-read bool $detached
 * @property-read bool $disposed
 * @method Page page()
 * @method-extended Page page()
 * @method HTTPResponse|null goto(string $url, array $options = [])
 * @method-extended HTTPResponse|null goto(string $url, array<string, mixed> $options = null)
 * @method HTTPResponse|null waitForNavigation(array $options = [])
 * @method-extended HTTPResponse|null waitForNavigation(array<string, mixed> $options = null)
 * @method Realm mainRealm()
 * @method-extended Realm mainRealm()
 * @method Realm isolatedRealm()
 * @method-extended Realm isolatedRealm()
 * @method void clearDocumentHandle()
 * @method-extended void clearDocumentHandle()
 * @method mixed|null frameElement()
 * @method-extended mixed|null frameElement()
 * @method mixed evaluateHandle(\Nesk\Puphpeteer\Rialto\Data\JsFunction $pageFunction, mixed ...$args)
 * @method-extended mixed evaluateHandle(callable|\Nesk\Puphpeteer\Rialto\Data\JsFunction $pageFunction, mixed ...$args)
 * @method mixed evaluate(\Nesk\Puphpeteer\Rialto\Data\JsFunction $pageFunction, mixed ...$args)
 * @method-extended mixed evaluate(callable|\Nesk\Puphpeteer\Rialto\Data\JsFunction $pageFunction, mixed ...$args)
 * @method mixed locator(\Nesk\Puphpeteer\Rialto\Data\JsFunction $func)
 * @method-extended mixed locator(callable(): mixed|\Nesk\Puphpeteer\Rialto\Data\JsFunction $func)
 * @method ElementHandle|mixed[]|null waitForSelector(mixed $selector, array $options = [])
 * @method-extended ElementHandle|mixed[]|null waitForSelector(mixed $selector, array<string, mixed> $options = null)
 * @method mixed waitForFunction(\Nesk\Puphpeteer\Rialto\Data\JsFunction $pageFunction, array $options = [], mixed ...$args)
 * @method-extended mixed waitForFunction(callable|\Nesk\Puphpeteer\Rialto\Data\JsFunction $pageFunction, array<string, mixed> $options = null, mixed ...$args)
 * @method string content()
 * @method-extended string content()
 * @method void setContent(string $html, array $options = [])
 * @method-extended void setContent(string $html, array<string, mixed> $options = null)
 * @method void setFrameContent(string $content)
 * @method-extended void setFrameContent(string $content)
 * @method string name()
 * @method-extended string name()
 * @method string url()
 * @method-extended string url()
 * @method Frame|null parentFrame()
 * @method-extended Frame|null parentFrame()
 * @method Frame[] childFrames()
 * @method-extended Frame[] childFrames()
 * @method bool isDetached()
 * @method-extended bool isDetached()
 * @method ElementHandle|mixed[] addScriptTag(array $options)
 * @method-extended ElementHandle|mixed[] addScriptTag(array<string, mixed> $options)
 * @method ElementHandle|mixed[] addStyleTag(array $options)
 * @method-extended ElementHandle|mixed[] addStyleTag(array<string, mixed> $options)
 * @method void click(string $selector, mixed $options = null)
 * @method-extended void click(string $selector, mixed $options = null)
 * @method void focus(string $selector)
 * @method-extended void focus(string $selector)
 * @method void hover(string $selector)
 * @method-extended void hover(string $selector)
 * @method string[] select(string $selector, string ...$values)
 * @method-extended string[] select(string $selector, string ...$values)
 * @method void tap(string $selector)
 * @method-extended void tap(string $selector)
 *
 * @method void type(string $selector, string $text, array $options = [])
 *
 * @method-extended void type(string $selector, string $text, array{ delay: float } $options = null)
 *
 * @method JSHandle|null waitFor(string|float|\Nesk\Puphpeteer\Rialto\Data\JsFunction $selectorOrFunctionOrTimeout, array|string[]|mixed[] $options = null, int|float|string|bool|null|array|JSHandle ...$args)
 *
 * @method-extended JSHandle|null waitFor(string|float|callable|\Nesk\Puphpeteer\Rialto\Data\JsFunction $selectorOrFunctionOrTimeout, array|string[]|mixed[] $options = null, int|float|string|bool|null|array|JSHandle ...$args)
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
 * @method JSHandle waitForFunction(\Nesk\Puphpeteer\Rialto\Data\JsFunction|string $pageFunction, array $options = [], int|float|string|bool|null|array|JSHandle ...$args)
 *
 * @method-extended JSHandle waitForFunction(callable|\Nesk\Puphpeteer\Rialto\Data\JsFunction|string $pageFunction, array<string, mixed> $options = null, int|float|string|bool|null|array|JSHandle ...$args)
 *
 * @method string title()
 * @method-extended string title()
 * @method mixed waitForDevicePrompt(array $options = [])
 * @method-extended mixed waitForDevicePrompt(array<string, mixed> $options = null)
 */
class Frame extends BasicResource
{
    use AliasesEvaluationMethods;
    use AliasesSelectionMethods;
}
