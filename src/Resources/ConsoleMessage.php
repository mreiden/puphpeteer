<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\BasicResource;

/**
 * @method mixed type()
 *
 * @method-extended mixed type()
 *
 * @method string text()
 *
 * @method-extended string text()
 *
 * @method JSHandle[] args()
 *
 * @method-extended JSHandle[] args()
 *
 * @method mixed location()
 *
 * @method-extended mixed location()
 *
 * @method mixed[] stackTrace()
 *
 * @method-extended mixed[] stackTrace()
 */
class ConsoleMessage extends BasicResource {}
