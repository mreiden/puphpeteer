<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\BasicResource;

/**
 * @method EventEmitter on(mixed $event, mixed $handler)
 *
 * @method-extended EventEmitter on(mixed $event, mixed $handler)
 *
 * @method EventEmitter off(mixed $event, mixed $handler)
 *
 * @method-extended EventEmitter off(mixed $event, mixed $handler)
 *
 * @method EventEmitter removeListener(mixed $event, mixed $handler)
 *
 * @method-extended EventEmitter removeListener(mixed $event, mixed $handler)
 *
 * @method EventEmitter addListener(mixed $event, mixed $handler)
 *
 * @method-extended EventEmitter addListener(mixed $event, mixed $handler)
 *
 * @method bool emit(mixed $event, mixed $eventData = null)
 *
 * @method-extended bool emit(mixed $event, mixed $eventData = null)
 *
 * @method EventEmitter once(mixed $event, mixed $handler)
 *
 * @method-extended EventEmitter once(mixed $event, mixed $handler)
 *
 * @method float listenerCount(mixed $event)
 *
 * @method-extended float listenerCount(mixed $event)
 *
 * @method EventEmitter removeAllListeners(mixed $event = null)
 *
 * @method-extended EventEmitter removeAllListeners(mixed $event = null)
 */
class EventEmitter extends BasicResource {}
