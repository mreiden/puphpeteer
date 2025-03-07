<?php

namespace Nesk\Puphpeteer\Resources;

use Nesk\Rialto\Data\BasicResource;

/**
 * @property mixed $idGenerator
 * @property mixed[] $touches
 * @method void removeHandle(mixed $handle)
 * @method-extended void removeHandle(mixed $handle)
 * @method void tap(float $x, float $y)
 * @method-extended void tap(float $x, float $y)
 * @method mixed touchStart(float $x, float $y)
 * @method-extended mixed touchStart(float $x, float $y)
 * @method void touchMove(float $x, float $y)
 * @method-extended void touchMove(float $x, float $y)
 * @method void touchEnd()
 * @method-extended void touchEnd()
 */
class Touchscreen extends BasicResource
{
}
