<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\BasicResource;

/**
 * @method void updateClient(CDPSession $client)
 * @method-extended void updateClient(CDPSession $client)
 * @method void start(array $options = [])
 * @method-extended void start(array<string, mixed> $options = null)
 * @method Uint8Array|null stop()
 * @method-extended Uint8Array|null stop()
 */
class Tracing extends BasicResource {}
