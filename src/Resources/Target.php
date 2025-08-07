<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\BasicResource;

/**
 * @method WebWorker|null worker()
 * @method-extended WebWorker|null worker()
 * @method Page|null page()
 * @method-extended Page|null page()
 * @method Page asPage()
 * @method-extended Page asPage()
 * @method string url()
 * @method-extended string url()
 * @method CDPSession createCDPSession()
 * @method-extended CDPSession createCDPSession()
 * @method mixed type()
 * @method-extended mixed type()
 * @method Browser browser()
 * @method-extended Browser browser()
 * @method BrowserContext browserContext()
 * @method-extended BrowserContext browserContext()
 * @method Target|null opener()
 * @method-extended Target|null opener()
 */
class Target extends BasicResource {}
