<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Traits;

use Nesk\Puphpeteer\Resources\ElementHandle;

/**
 * @method-extended  ElementHandle|null querySelector(string $selector)
 * @method-extended  ElementHandle[]    querySelectorAll(string $selector)
 * @method-extended  ElementHandle[]    querySelectorXPath(string $expression)
 */
trait AliasesSelectionMethods
{
    public function querySelector(...$arguments): ?ElementHandle
    {
        return $this->__call('$', $arguments);
    }

    /**
     * @return ElementHandle[]
     */
    public function querySelectorAll(...$arguments): array
    {
        return $this->__call('$$', $arguments);
    }

    /**
     * @return ElementHandle[]
     */
    public function querySelectorXPath(...$arguments): array
    {
        /**
         * Puppeteer 22.0.0 removed the Page.$x function (@see https://github.com/puppeteer/puppeteer/pull/11782)
         */
        if (!empty($arguments[0])) {
            if (str_starts_with($arguments[0], '//')) {
                $arguments[0] = '.' . $arguments[0];
            }

            if (!str_starts_with($arguments[0], 'xpath/')) {
                $arguments[0] = 'xpath/' . $arguments[0];
            }
        }
        return $this->__call('$$', $arguments);
    }
}
