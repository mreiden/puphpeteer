<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Tests\Rialto\Implementation;

use Nesk\Puphpeteer\Rialto\AbstractEntryPoint;

class FsWithoutProcessDelegation extends AbstractEntryPoint
{
    public function __construct()
    {
        parent::__construct(__DIR__ . '/FsConnectionDelegate.mjs');
    }
}
