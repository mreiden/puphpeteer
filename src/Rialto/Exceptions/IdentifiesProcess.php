<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Rialto\Exceptions;

use Symfony\Component\Process\Process;

trait IdentifiesProcess
{
    /**
     * The associated process.
     */
    private Process $process;

    /**
     * Return the associated process.
     */
    public function getProcess(): Process
    {
        return $this->process;
    }
}
