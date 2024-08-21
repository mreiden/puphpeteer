<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Tests;

use Nesk\Puphpeteer\Rialto\Exceptions\Node\FatalException as NodeFatalException;

final class RiskyResource
{
    protected $value = null;
    protected $exception = null;

    public function __construct(callable $resourceRetriever)
    {
        try {
            $this->value = $resourceRetriever();
        } catch (NodeFatalException $exception) {
            $this->exception = $exception;
        }
    }

    public function value()
    {
        return $this->value;
    }

    public function exception(): ?NodeFatalException
    {
        return $this->exception;
    }
}
