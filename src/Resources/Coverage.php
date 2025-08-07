<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\BasicResource;

/**
 * @method void updateClient(\Nesk\Puphpeteer\Resources\CDPSession $client)
 * @method-extended void updateClient(\Nesk\Puphpeteer\Resources\CDPSession $client)
 * @method void startJSCoverage(array $options = [])
 * @method-extended void startJSCoverage(array<string, mixed> $options = null)
 * @method mixed[] stopJSCoverage()
 * @method-extended mixed[] stopJSCoverage()
 * @method void startCSSCoverage(array $options = [])
 * @method-extended void startCSSCoverage(array<string, mixed> $options = null)
 * @method mixed[] stopCSSCoverage()
 * @method-extended mixed[] stopCSSCoverage()
 */
class Coverage extends BasicResource {}
