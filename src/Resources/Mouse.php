<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\BasicResource;

/**
 * @method void reset()
 * @method-extended void reset()
 * @method void move(float $x, float $y, mixed $options = null)
 * @method-extended void move(float $x, float $y, mixed $options = null)
 * @method void down(mixed $options = null)
 * @method-extended void down(mixed $options = null)
 * @method void up(mixed $options = null)
 * @method-extended void up(mixed $options = null)
 * @method void click(float $x, float $y, mixed $options = null)
 * @method-extended void click(float $x, float $y, mixed $options = null)
 * @method void wheel(mixed $options = null)
 * @method-extended void wheel(mixed $options = null)
 * @method mixed drag(mixed $start, mixed $target)
 * @method-extended mixed drag(mixed $start, mixed $target)
 * @method void dragEnter(mixed $target, mixed $data)
 * @method-extended void dragEnter(mixed $target, mixed $data)
 * @method void dragOver(mixed $target, mixed $data)
 * @method-extended void dragOver(mixed $target, mixed $data)
 * @method void drop(mixed $target, mixed $data)
 * @method-extended void drop(mixed $target, mixed $data)
 * @method void dragAndDrop(mixed $start, mixed $target, array $options = [])
 * @method-extended void dragAndDrop(mixed $start, mixed $target, array{ $delay: float } $options = null)
 */
class Mouse extends BasicResource {}
