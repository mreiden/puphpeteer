<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer;

use Nesk\Puphpeteer\Rialto\{Interfaces\ShouldHandleProcessDelegation, Traits\UsesBasicResourceAsDefault};

class PuppeteerProcessDelegate implements ShouldHandleProcessDelegation
{
    use UsesBasicResourceAsDefault;

    public function resourceFromOriginalClassName(string $className): ?string
    {
        // Remove the "CDP"/"Cdp" prefix if it exists
        if (str_starts_with(strtoupper($className), 'CDP')) {
            $className = substr($className, 3);
        }

        $className = __NAMESPACE__ . "\\Resources\\$className";
        if (class_exists($className)) {
            return $className;
        }

        return null;
    }
}
