<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Rialto\Data;

use Nesk\Puphpeteer\Rialto\Exceptions\Node\Exception;
use Nesk\Puphpeteer\Rialto\Interfaces\{
    ShouldHandleProcessDelegation,
    ShouldIdentifyResource,
    ShouldCommunicateWithProcessSupervisor,
};

trait UnserializesData
{
    /**
     * Unserialize a value.
     */
    protected function unserialize($value)
    {
        if (!is_array($value)) {
            return $value;
        }

        if (array_key_exists('__rialto_error__', $value) && $value['__rialto_error__'] === true) {
            return new Exception($value, $this->options['debug']);
        }

        if (($value['__rialto_resource__'] ?? false) === true) {
            if ($this->delegate instanceof ShouldHandleProcessDelegation) {
                $classPath =
                    $this->delegate->resourceFromOriginalClassName($value['class_name']) ?:
                    $this->delegate->defaultResource();
            } else {
                $classPath = $this->defaultResource();
            }

            $resource = new $classPath();
            if ($resource instanceof ShouldIdentifyResource) {
                $resource->setResourceIdentity(new ResourceIdentity($value['class_name'], $value['id']));
            }
            if ($resource instanceof ShouldCommunicateWithProcessSupervisor) {
                $resource->setProcessSupervisor($this);
            }

            return $resource;
        }

        return array_map(fn($value) => $this->unserialize($value), $value);
    }
}
