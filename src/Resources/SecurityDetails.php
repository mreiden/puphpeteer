<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\BasicResource;

/**
 * @method string issuer()
 *
 * @method-extended string issuer()
 *
 * @method float validFrom()
 *
 * @method-extended float validFrom()
 *
 * @method float validTo()
 *
 * @method-extended float validTo()
 *
 * @method string protocol()
 *
 * @method-extended string protocol()
 *
 * @method string subjectName()
 *
 * @method-extended string subjectName()
 *
 * @method string[] subjectAlternativeNames()
 *
 * @method-extended string[] subjectAlternativeNames()
 */
class SecurityDetails extends BasicResource {}
