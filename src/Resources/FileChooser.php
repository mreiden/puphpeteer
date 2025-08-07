<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\BasicResource;

/**
 * @method bool isMultiple()
 * @method-extended bool isMultiple()
 * @method void accept(string[] $paths)
 * @method-extended void accept(string[] $paths)
 * @method void cancel()
 * @method-extended void cancel()
 */
class FileChooser extends BasicResource {}
