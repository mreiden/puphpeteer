<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Rialto\Traits;

use Nesk\Puphpeteer\Rialto\Data\BasicResource;

trait UsesBasicResourceAsDefault
{
    /**
     * Return the fully qualified name of the default resource.
     */
    public function defaultResource(): string
    {
        return BasicResource::class;
    }
}
