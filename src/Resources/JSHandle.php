<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\{BasicResource, JsFunction};

/**
 * @method ExecutionContext executionContext()
 *
 * @method-extended \Nesk\Puphpeteer\Resources\ExecutionContext executionContext()
 *
 * @method mixed evaluate(JsFunction $pageFunction, int|float|string|bool|array|JSHandle|null ...$args)
 *
 * @method-extended mixed evaluate(callable|JsFunction $pageFunction, int|float|string|bool|null|array|JSHandle ...$args)
 *
 * @method JSHandle|ElementHandle evaluateHandle(JsFunction|string $pageFunction, int|float|string|bool|array|JSHandle|null ...$args)
 *
 * @method-extended JSHandle|ElementHandle evaluateHandle(JsFunction|callable|string $pageFunction, int|float|string|bool|null|array|JSHandle ...$args)
 *
 * @method JSHandle getProperty(string $propertyName)
 *
 * @method-extended JSHandle getProperty(string $propertyName)
 *
 * @method array|string[]|JSHandle[] getProperties()
 *
 * @method-extended array|string[]|JSHandle[] getProperties()
 *
 * @method mixed jsonValue()
 *
 * @method-extended mixed jsonValue()
 *
 * @method ElementHandle|null asElement()
 *
 * @method-extended ElementHandle|null asElement()
 *
 * @method void dispose()
 *
 * @method-extended void dispose()
 *
 * @method string toString()
 *
 * @method-extended string toString()
 */
class JSHandle extends BasicResource {}
