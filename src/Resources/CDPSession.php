<?php

namespace Nesk\Puphpeteer\Resources;

/**
 * @property-read bool $detached
 * @method mixed|null connection()
 * @method-extended mixed|null connection()
 * @method \Nesk\Puphpeteer\Resources\CDPSession|null parentSession()
 * @method-extended \Nesk\Puphpeteer\Resources\CDPSession|null parentSession()
 * @method mixed send(mixed $method, mixed $params = null, array $options = [])
 * @method-extended mixed send(mixed $method, mixed $params = null, array<string, mixed> $options = null)
 * @method void detach()
 * @method-extended void detach()
 * @method string id()
 * @method-extended string id()
 */
class CDPSession extends EventEmitter
{
}
