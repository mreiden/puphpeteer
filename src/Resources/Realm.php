<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

/**
 * @property TaskManager $taskManager
 * @property-read mixed $environment
 * @property-read bool $disposed
 * @method mixed adoptHandle(mixed $handle)
 * @method-extended mixed adoptHandle(mixed $handle)
 * @method mixed transferHandle(mixed $handle)
 * @method-extended mixed transferHandle(mixed $handle)
 * @method mixed evaluateHandle(\Nesk\Puphpeteer\Rialto\Data\JsFunction $pageFunction, mixed ...$args)
 * @method-extended mixed evaluateHandle(callable|\Nesk\Puphpeteer\Rialto\Data\JsFunction $pageFunction, mixed ...$args)
 * @method mixed evaluate(\Nesk\Puphpeteer\Rialto\Data\JsFunction $pageFunction, mixed ...$args)
 * @method-extended mixed evaluate(callable|\Nesk\Puphpeteer\Rialto\Data\JsFunction $pageFunction, mixed ...$args)
 * @method mixed waitForFunction(\Nesk\Puphpeteer\Rialto\Data\JsFunction $pageFunction, array $options = [], mixed ...$args)
 * @method-extended mixed waitForFunction(callable|\Nesk\Puphpeteer\Rialto\Data\JsFunction $pageFunction, array{ $polling: 'raf'|'mutation'|float, $timeout: float, $root: ElementHandle|mixed[], $signal: mixed } $options = null, mixed ...$args)
 * @method JSHandle|mixed[] adoptBackendNode(float $backendNodeId = null)
 * @method-extended JSHandle|mixed[] adoptBackendNode(float $backendNodeId = null)
 * @method void dispose()
 * @method-extended void dispose()
 */
class Realm {}
