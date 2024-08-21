<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Tests\Rialto\Implementation;

use Nesk\Puphpeteer\Rialto\{Interfaces\ShouldHandleProcessDelegation, Traits\UsesBasicResourceAsDefault};

class FsProcessDelegate implements ShouldHandleProcessDelegation
{
    use UsesBasicResourceAsDefault;

    public function resourceFromOriginalClassName(string $className): ?string
    {
        $class = __NAMESPACE__ . "\\Resources\\$className";

        return class_exists($class) ? $class : null;
    }
}
