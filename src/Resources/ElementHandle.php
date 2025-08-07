<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Traits\{AliasesEvaluationMethods, AliasesSelectionMethods};

/**
 * @property mixed $isolatedHandle
 * @property-read string|null $id
 * @property-read bool $disposed
 * @property-read Frame $frame
 * @method mixed getProperty(mixed $propertyName)
 * @method-extended mixed getProperty(mixed $propertyName)
 * @method array|string[]|JSHandle[] getProperties()
 * @method-extended array|string[]|JSHandle[] getProperties()
 * @method mixed evaluate(\Nesk\Puphpeteer\Rialto\Data\JsFunction $pageFunction, mixed ...$args)
 * @method-extended mixed evaluate(callable|\Nesk\Puphpeteer\Rialto\Data\JsFunction $pageFunction, mixed ...$args)
 * @method mixed evaluateHandle(\Nesk\Puphpeteer\Rialto\Data\JsFunction $pageFunction, mixed ...$args)
 * @method-extended mixed evaluateHandle(callable|\Nesk\Puphpeteer\Rialto\Data\JsFunction $pageFunction, mixed ...$args)
 * @method mixed jsonValue()
 * @method-extended mixed jsonValue()
 * @method string toString()
 * @method-extended string toString()
 * @method mixed remoteObject()
 * @method-extended mixed remoteObject()
 * @method void dispose()
 * @method-extended void dispose()
 * @method ElementHandle|mixed[] asElement()
 * @method-extended ElementHandle|mixed[] asElement()
 * @method ElementHandle|mixed[]|null waitForSelector(mixed $selector, array $options = [])
 * @method-extended ElementHandle|mixed[]|null waitForSelector(mixed $selector, array<string, mixed> $options = null)
 * @method bool isVisible()
 * @method-extended bool isVisible()
 * @method bool isHidden()
 * @method-extended bool isHidden()
 * @method mixed toElement(mixed $tagName)
 * @method-extended mixed toElement(mixed $tagName)
 * @method Frame|null contentFrame()
 * @method-extended Frame|null contentFrame()
 * @method mixed clickablePoint(mixed $offset = null)
 * @method-extended mixed clickablePoint(mixed $offset = null)
 * @method void hover(ElementHandle|mixed[] $selector)
 * @method-extended void hover(ElementHandle|mixed[] $selector)
 * @method void click(ElementHandle|mixed[] $selector, mixed $options = null)
 * @method-extended void click(ElementHandle|mixed[] $selector, mixed $options = null)
 * @method mixed|null drag(ElementHandle|mixed[] $selector, mixed|ElementHandle|mixed[] $target)
 * @method-extended mixed|null drag(ElementHandle|mixed[] $selector, mixed|ElementHandle|mixed[] $target)
 * @method void dragEnter(ElementHandle|mixed[] $selector, mixed $data = null)
 * @method-extended void dragEnter(ElementHandle|mixed[] $selector, mixed $data = null)
 * @method void dragOver(ElementHandle|mixed[] $selector, mixed $data = null)
 * @method-extended void dragOver(ElementHandle|mixed[] $selector, mixed $data = null)
 * @method void drop(ElementHandle|mixed[] $selector, mixed $data = null)
 * @method-extended void drop(ElementHandle|mixed[] $selector, mixed $data = null)
 * @method void dragAndDrop(ElementHandle|mixed[] $selector, ElementHandle|mixed[] $target, array $options = [])
 * @method-extended void dragAndDrop(ElementHandle|mixed[] $selector, ElementHandle|mixed[] $target, array{ $delay: float } $options = null)
 * @method string[] select(string ...$values)
 * @method-extended string[] select(string ...$values)
 * @method void uploadFile(ElementHandle|mixed[] $selector, string ...$paths)
 * @method-extended void uploadFile(ElementHandle|mixed[] $selector, string ...$paths)
 * @method mixed queryAXTree(string $name = null, string $role = null)
 * @method-extended mixed queryAXTree(string $name = null, string $role = null)
 * @method void tap(ElementHandle|mixed[] $selector)
 * @method-extended void tap(ElementHandle|mixed[] $selector)
 * @method mixed touchStart(ElementHandle|mixed[] $selector)
 * @method-extended mixed touchStart(ElementHandle|mixed[] $selector)
 * @method void touchMove(ElementHandle|mixed[] $selector, mixed $touch = null)
 * @method-extended void touchMove(ElementHandle|mixed[] $selector, mixed $touch = null)
 * @method void touchEnd(ElementHandle|mixed[] $selector)
 * @method-extended void touchEnd(ElementHandle|mixed[] $selector)
 * @method void focus()
 * @method-extended void focus()
 * @method void type(string $text, mixed $options = null)
 * @method-extended void type(string $text, mixed $options = null)
 * @method void press(mixed $key, mixed $options = null)
 * @method-extended void press(mixed $key, mixed $options = null)
 * @method mixed|null boundingBox()
 * @method-extended mixed|null boundingBox()
 * @method mixed|null boxModel()
 * @method-extended mixed|null boxModel()
 * @method Uint8Array screenshot(mixed $options = null)
 * @method-extended Uint8Array screenshot(mixed $options = null)
 * @method bool isIntersectingViewport(ElementHandle|mixed[] $selector, array $options = [])
 * @method-extended bool isIntersectingViewport(ElementHandle|mixed[] $selector, array{ $threshold: float } $options = null)
 * @method void scrollIntoView(ElementHandle|mixed[] $selector)
 * @method-extended void scrollIntoView(ElementHandle|mixed[] $selector)
 * @method void autofill(mixed $data)
 * @method-extended void autofill(mixed $data)
 * @method float backendNodeId()
 * @method-extended float backendNodeId()
 */
class ElementHandle extends JSHandle
{
    use AliasesEvaluationMethods;
    use AliasesSelectionMethods;
}
