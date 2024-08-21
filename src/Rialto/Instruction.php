<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Rialto;

use BadMethodCallException;
use Closure;
use InvalidArgumentException;
use JsonSerializable;
use Nesk\Puphpeteer\Rialto\Data\{BasicResource, ResourceIdentity};

class Instruction implements JsonSerializable
{
    public const string TYPE_CALL = 'call';
    public const string TYPE_GET = 'get';
    public const string TYPE_SET = 'set';
    public const string TYPE_NOOP = 'noop';

    /**
     * The instruction type.
     */
    protected string $type = self::TYPE_NOOP;

    /**
     * The name the instruction refers to.
     */
    protected ?string $name = null;

    /**
     * The value(s) the instruction should use.
     *
     * @var array[]|array|null
     */
    protected $value;

    /**
     * The resource associated to the instruction.
     */
    protected ?BasicResource $resource;
    //    protected BasicResource|ResourceIdentity|string|null $resource;

    /**
     * Define whether instruction errors should be caught.
     */
    protected bool $shouldCatchErrors = false;

    /**
     * Create a no-op instruction.
     */
    public static function noop(): self
    {
        return new self();
    }

    /**
     * Define a method call.
     */
    public function call(string $name, ...$arguments): self
    {
        $this->type = self::TYPE_CALL;
        $this->name = $name;
        $this->setValue($arguments, $this->type);

        return $this;
    }

    /**
     * Define a getter.
     */
    public function get(string $name): self
    {
        $this->type = self::TYPE_GET;
        $this->name = $name;
        $this->setValue(null, $this->type);

        return $this;
    }

    /**
     * Define a setter.
     */
    public function set(string $name, $value): self
    {
        $this->type = self::TYPE_SET;
        $this->name = $name;
        $this->setValue($value, $this->type);

        return $this;
    }

    /**
     * Link the instruction to the provided resource.
     */
    public function linkToResource(BasicResource|ResourceIdentity|string|null $resource = null): self
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Define if instruction errors should be caught.
     */
    public function shouldCatchErrors(bool $catch): self
    {
        $this->shouldCatchErrors = $catch;

        return $this;
    }

    /**
     * Set the instruction value.
     */
    protected function setValue($value, string $type)
    {
        $this->value =
            $type !== self::TYPE_CALL
                ? $this->validateValue($value)
                : array_map(fn($value) => $this->validateValue($value), $value);
    }

    /**
     * Validate a value.
     *
     * @throws InvalidArgumentException if the value contains PHP closures.
     */
    protected function validateValue($value)
    {
        if ($value instanceof Closure) {
            throw new InvalidArgumentException('You must use JS function wrappers instead of PHP closures.');
        }

        return $value;
    }

    /**
     * Serialize the object to a value that can be serialized natively by {@see json_encode}.
     */
    public function jsonSerialize(): array
    {
        $instruction = ['type' => $this->type];

        if ($this->type !== self::TYPE_NOOP) {
            $instruction = array_merge($instruction, [
                'name' => $this->name,
                'shouldCatchErrors' => $this->shouldCatchErrors,
            ]);

            if ($this->type !== self::TYPE_GET) {
                $instruction['value'] = $this->value;
            }

            if ($this->resource !== null) {
                $instruction['resource'] = $this->resource;
            }
        }

        return $instruction;
    }

    /**
     * Proxy the "with*" static method calls to the "*" non-static method calls of a new instance.
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $name = lcfirst(substr($name, strlen('with')));

        if ($name === 'jsonSerialize') {
            throw new BadMethodCallException();
        }

        return call_user_func([new self(), $name], ...$arguments);
    }
}
