<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\BasicResource;

/**
 * @method CDPSession createCDPSession()
 *
 * @method-extended CDPSession createCDPSession()
 *
 * @method Page|null page()
 *
 * @method-extended Page|null page()
 *
 * @method WebWorker|null worker()
 *
 * @method-extended WebWorker|null worker()
 *
 * @method string url()
 *
 * @method-extended string url()
 *
 * @method string type()
 *
 * @method-extended string type()
 *
 * @method Browser browser()
 *
 * @method-extended Browser browser()
 *
 * @method BrowserContext browserContext()
 *
 * @method-extended BrowserContext browserContext()
 *
 * @method Target|null opener()
 *
 * @method-extended Target|null opener()
 */
class Target extends BasicResource {}
