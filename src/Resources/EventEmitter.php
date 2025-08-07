<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\BasicResource;

/**
 * @method mixed on(mixed $type, mixed $handler)
 * @method-extended mixed on(mixed $type, mixed $handler)
 * @method mixed off(mixed $type, mixed $handler = null)
 * @method-extended mixed off(mixed $type, mixed $handler = null)
 * @method bool emit(mixed $type, mixed $event)
 * @method-extended bool emit(mixed $type, mixed $event)
 * @method mixed once(mixed $type, mixed $handler)
 * @method-extended mixed once(mixed $type, mixed $handler)
 * @method float listenerCount(mixed $type)
 * @method-extended float listenerCount(mixed $type)
 * @method mixed removeAllListeners(mixed $type = null)
 * @method-extended mixed removeAllListeners(mixed $type = null)
 */
class EventEmitter extends BasicResource {}
