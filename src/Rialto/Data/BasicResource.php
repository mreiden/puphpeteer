<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Rialto\Data;

use JsonSerializable;
use Nesk\Puphpeteer\Rialto\{
    Interfaces\ShouldCommunicateWithProcessSupervisor,
    Interfaces\ShouldIdentifyResource,
    Traits\IdentifiesResource,
    Traits\CommunicatesWithProcessSupervisor,
};

class BasicResource implements ShouldIdentifyResource, ShouldCommunicateWithProcessSupervisor, JsonSerializable
{
    use IdentifiesResource;
    use CommunicatesWithProcessSupervisor;

    /**
     * Serialize the object to a value that can be serialized natively by {@see json_encode}.
     */
    public function jsonSerialize(): ResourceIdentity
    {
        return $this->getResourceIdentity();
    }
}
