<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\BasicResource;

/**
 * @method void down(mixed $key, mixed $options = null)
 * @method-extended void down(mixed $key, mixed $options = null)
 * @method void up(mixed $key)
 * @method-extended void up(mixed $key)
 * @method void sendCharacter(string $char)
 * @method-extended void sendCharacter(string $char)
 * @method void type(string $text, mixed $options = null)
 * @method-extended void type(string $text, mixed $options = null)
 * @method void press(mixed $key, mixed $options = null)
 * @method-extended void press(mixed $key, mixed $options = null)
 */
class Keyboard extends BasicResource {}
