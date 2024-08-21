<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Rialto\Interfaces;

use Nesk\Puphpeteer\Rialto\ProcessSupervisor;

interface ShouldCommunicateWithProcessSupervisor
{
    /**
     * Set the process supervisor.
     *
     * @throws \RuntimeException if the process has already been set.
     */
    public function setProcessSupervisor(ProcessSupervisor $process): void;
}
