<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Rialto\Traits;

use Nesk\Puphpeteer\Rialto\{
    Exceptions\Node\Exception,
    Instruction,
    Interfaces\ShouldIdentifyResource,
    ProcessSupervisor,
};
use Nesk\Puphpeteer\Resources\Browser;
use RuntimeException;

trait CommunicatesWithProcessSupervisor
{
    /**
     * The process supervisor to communicate with.
     */
    protected ?ProcessSupervisor $processSupervisor = null;

    /**
     * Whether the current resource should catch instruction errors.
     */
    protected bool $catchInstructionErrors = false;

    /**
     * Get the process supervisor.
     */
    protected function getProcessSupervisor(): ProcessSupervisor
    {
        return $this->processSupervisor;
    }

    /**
     * Set the process supervisor.
     *
     * @throws RuntimeException if the process supervisor has already been set.
     */
    public function setProcessSupervisor(ProcessSupervisor $process): void
    {
        if ($this->processSupervisor !== null) {
            throw new RuntimeException('The process supervisor has already been set.');
        }

        $this->processSupervisor = $process;
    }

    /**
     * Clone the resource and catch its instruction errors.
     */
    protected function createCatchingResource()
    {
        $resource = clone $this;

        $resource->catchInstructionErrors = true;

        return $resource;
    }

    /**
     * Proxy an action.
     */
    protected function proxyAction(string $actionType, string $name, $value = null)
    {
        switch ($actionType) {
            case Instruction::TYPE_CALL:
                $value ??= [];
                $instruction = Instruction::withCall($name, ...$value);

                //$instruction->linkToResource(Browser::class);
                break;
            case Instruction::TYPE_GET:
                $instruction = Instruction::withGet($name);
                break;
            case Instruction::TYPE_SET:
                $instruction = Instruction::withSet($name, $value);
                break;
        }

        $instruction->linkToResource($this instanceof ShouldIdentifyResource ? $this : null);

        if ($this->catchInstructionErrors) {
            $instruction->shouldCatchErrors(true);
        }

        return $this->getProcessSupervisor()->executeInstruction($instruction);
    }

    /**
     * Proxy the string casting to the process supervisor.
     */
    public function __toString(): string
    {
        return $this->proxyAction(Instruction::TYPE_CALL, 'toString');
    }

    /**
     * Proxy the method call to the process supervisor.
     */
    public function __call(string $name, array $arguments)
    {
        return $this->proxyAction(Instruction::TYPE_CALL, $name, $arguments);
    }

    /**
     * Proxy the property reading to the process supervisor.
     */
    public function __get(string $name)
    {
        if ($name === 'tryCatch' && !$this->catchInstructionErrors) {
            return $this->createCatchingResource();
        }

        return $this->proxyAction(Instruction::TYPE_GET, $name);
    }

    /**
     * Proxy the property writing to the process supervisor.
     */
    public function __set(string $name, $value)
    {
        return $this->proxyAction(Instruction::TYPE_SET, $name, $value);
    }
}
