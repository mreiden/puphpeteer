<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\{BasicResource, JsFunction};

/**
 * @method string url()
 *
 * @method-extended string url()
 *
 * @method mixed continueRequestOverrides()
 *
 * @method-extended mixed continueRequestOverrides()
 *
 * @method mixed|null responseForRequest()
 *
 * @method-extended mixed|null responseForRequest()
 *
 * @method mixed|null abortErrorReason()
 *
 * @method-extended mixed|null abortErrorReason()
 *
 * @method mixed interceptResolutionState()
 *
 * @method-extended mixed interceptResolutionState()
 *
 * @method bool isInterceptResolutionHandled()
 *
 * @method-extended bool isInterceptResolutionHandled()
 *
 * @method void enqueueInterceptAction(JsFunction $pendingHandler)
 *
 * @method-extended void enqueueInterceptAction(callable(): null|mixed|JsFunction $pendingHandler)
 *
 * @method void finalizeInterceptions()
 *
 * @method-extended void finalizeInterceptions()
 *
 * @method mixed resourceType()
 *
 * @method-extended mixed resourceType()
 *
 * @method string method()
 *
 * @method-extended string method()
 *
 * @method string|null postData()
 *
 * @method-extended string|null postData()
 *
 * @method array|string[]|string[] headers()
 *
 * @method-extended array|string[]|string[] headers()
 *
 * @method HTTPResponse|null response()
 *
 * @method-extended HTTPResponse|null response()
 *
 * @method Frame|null frame()
 *
 * @method-extended Frame|null frame()
 *
 * @method bool isNavigationRequest()
 *
 * @method-extended bool isNavigationRequest()
 *
 * @method mixed initiator()
 *
 * @method-extended mixed initiator()
 *
 * @method HTTPRequest[] redirectChain()
 *
 * @method-extended HTTPRequest[] redirectChain()
 *
 * @method array|null failure()
 *
 * @method-extended array{ errorText: string }|null failure()
 *
 * @method void continue(mixed $overrides = null, float $priority = null)
 *
 * @method-extended void continue(mixed $overrides = null, float $priority = null)
 *
 * @method void respond(mixed $response, float $priority = null)
 *
 * @method-extended void respond(mixed $response, float $priority = null)
 *
 * @method void abort(mixed $errorCode = null, float $priority = null)
 *
 * @method-extended void abort(mixed $errorCode = null, float $priority = null)
 */
class HTTPRequest extends BasicResource {}
