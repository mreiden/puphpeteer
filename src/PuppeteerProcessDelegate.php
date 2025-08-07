<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer;

use Nesk\Puphpeteer\Rialto\Interfaces\ShouldHandleProcessDelegation;
use Nesk\Puphpeteer\Rialto\Traits\UsesBasicResourceAsDefault;

class PuppeteerProcessDelegate implements ShouldHandleProcessDelegation
{
    use UsesBasicResourceAsDefault;

    public function resourceFromOriginalClassName(string $className): ?string
    {
        $namespace = "Nesk\\Puphpeteer\\Resources";
        $class = "$namespace\\$className";
        if (class_exists($class)) {
            return $class;
        }

        // Try again by removing the Cdp resource prefix if it exists
        if (str_starts_with(strtoupper($className), "CDP")) {
            $classWithoutCDP = $namespace . "\\" . substr($className, 3);
            if (class_exists($classWithoutCDP)) {
                return $classWithoutCDP;
            }
        }

        return null;
    }
}
