<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\BasicResource;

/**
 * @method mixed remoteAddress()
 *
 * @method-extended mixed remoteAddress()
 *
 * @method string url()
 *
 * @method-extended string url()
 *
 * @method bool ok()
 *
 * @method-extended bool ok()
 *
 * @method float status()
 *
 * @method-extended float status()
 *
 * @method string statusText()
 *
 * @method-extended string statusText()
 *
 * @method array|string[]|string[] headers()
 *
 * @method-extended array|string[]|string[] headers()
 *
 * @method SecurityDetails|null securityDetails()
 *
 * @method-extended SecurityDetails|null securityDetails()
 *
 * @method mixed|null timing()
 *
 * @method-extended mixed|null timing()
 *
 * @method mixed buffer()
 *
 * @method-extended mixed buffer()
 *
 * @method string text()
 *
 * @method-extended string text()
 *
 * @method mixed json()
 *
 * @method-extended mixed json()
 *
 * @method HTTPRequest request()
 *
 * @method-extended HTTPRequest request()
 *
 * @method bool fromCache()
 *
 * @method-extended bool fromCache()
 *
 * @method bool fromServiceWorker()
 *
 * @method-extended bool fromServiceWorker()
 *
 * @method Frame|null frame()
 *
 * @method-extended Frame|null frame()
 */
class HTTPResponse extends BasicResource {}
