<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\BasicResource;

/**
 * @property TimeoutSettings $timeoutSettings
 * @property-read CDPSession $client
 * @method Realm mainRealm()
 * @method-extended Realm mainRealm()
 * @method string url()
 * @method-extended string url()
 * @method mixed evaluate(mixed|string $func, mixed ...$args)
 * @method-extended mixed evaluate(mixed|string $func, mixed ...$args)
 * @method mixed evaluateHandle(mixed|string $func, mixed ...$args)
 * @method-extended mixed evaluateHandle(mixed|string $func, mixed ...$args)
 * @method void close()
 * @method-extended void close()
 */
class WebWorker extends BasicResource {}
