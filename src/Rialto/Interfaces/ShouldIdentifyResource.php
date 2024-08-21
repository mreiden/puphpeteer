<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Rialto\Interfaces;

use Nesk\Puphpeteer\Rialto\Data\ResourceIdentity;

interface ShouldIdentifyResource
{
    /**
     * Return the identity of the resource.
     */
    public function getResourceIdentity(): ?ResourceIdentity;

    /**
     * Set the identity of the resource.
     *
     * @throws \RuntimeException if the resource identity has already been set.
     */
    public function setResourceIdentity(ResourceIdentity $identity): void;
}
