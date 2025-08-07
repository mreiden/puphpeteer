<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\{BasicResource, JsFunction};

/**
 * @property \Nesk\Rialto\Data\JsFunction $move
 * @property-read Realm $realm
 * @property-read bool $disposed
 * @property-read string|null $id
 * @method mixed evaluate(\Nesk\Rialto\Data\JsFunction $pageFunction, mixed ...$args)
 * @method-extended mixed evaluate(callable|\Nesk\Rialto\Data\JsFunction $pageFunction, mixed ...$args)
 * @method mixed evaluateHandle(\Nesk\Rialto\Data\JsFunction $pageFunction, mixed ...$args)
 * @method-extended mixed evaluateHandle(callable|\Nesk\Rialto\Data\JsFunction $pageFunction, mixed ...$args)
 * @method JSHandle|mixed[] getProperty(string $propertyName)
 * @method-extended JSHandle|mixed[] getProperty(string $propertyName)
 * @method array|string[]|JSHandle[] getProperties()
 * @method-extended array|string[]|JSHandle[] getProperties()
 * @method mixed jsonValue()
 * @method-extended mixed jsonValue()
 * @method ElementHandle|mixed[]|null asElement()
 * @method-extended ElementHandle|mixed[]|null asElement()
 * @method void dispose()
 * @method-extended void dispose()
 * @method string toString()
 * @method-extended string toString()
 * @method mixed remoteObject()
 * @method-extended mixed remoteObject()
 */
class JSHandle extends BasicResource {}
