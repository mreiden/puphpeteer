<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Traits;

/**
 * @method null|array|bool|float|int|string querySelectorEval(string $selector, JsFunction $pageFunction, null|array|bool|float|int|JSHandle|string ...$args)
 * @method null|array|bool|float|int|string querySelectorAllEval(string $selector, JsFunction $pageFunction, null|array|bool|float|int|JSHandle|string ...$args)
 */
trait AliasesEvaluationMethods
{
    public function querySelectorEval(...$arguments)
    {
        return $this->__call('$eval', $arguments);
    }

    public function querySelectorAllEval(...$arguments)
    {
        return $this->__call('$$eval', $arguments);
    }
}
