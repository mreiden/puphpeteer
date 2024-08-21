<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Rialto\Traits;

use Nesk\Puphpeteer\Rialto\Data\ResourceIdentity;
use RuntimeException;

trait IdentifiesResource
{
    /**
     * The identity of the resource.
     */
    protected ?ResourceIdentity $resourceIdentity = null;

    /**
     * Return the identity of the resource.
     */
    public function getResourceIdentity(): ?ResourceIdentity
    {
        return $this->resourceIdentity;
    }

    /**
     * Set the identity of the resource.
     *
     * @throws RuntimeException if the resource identity has already been set.
     */
    public function setResourceIdentity(ResourceIdentity $identity): void
    {
        if ($this->resourceIdentity !== null) {
            throw new RuntimeException('The resource identity has already been set.');
        }

        $this->resourceIdentity = $identity;
    }
}
