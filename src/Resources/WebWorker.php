<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\{BasicResource, JsFunction};

/**
 * @method string url()
 *
 * @method-extended string url()
 *
 * @method ExecutionContext executionContext()
 *
 * @method-extended ExecutionContext executionContext()
 *
 * @method mixed evaluate(JsFunction|string $pageFunction, mixed ...$args)
 *
 * @method-extended mixed evaluate(callable|JsFunction|string $pageFunction, mixed ...$args)
 *
 * @method JSHandle evaluateHandle(JsFunction|string $pageFunction, int|float|string|bool|array|JSHandle|null ...$args)
 *
 * @method-extended JSHandle evaluateHandle(JsFunction|callable|string $pageFunction, int|float|string|bool|null|array|JSHandle ...$args)
 */
class WebWorker extends BasicResource {}
