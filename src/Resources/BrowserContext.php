<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\JsFunction;

/**
 * @method Target[] targets()
 *
 * @method-extended Target[] targets()
 *
 * @method Target waitForTarget(JsFunction $predicate, array $options = [])
 *
 * @method-extended Target waitForTarget(callable(Target $x): bool|Promise|bool[]|JsFunction $predicate, array{ timeout: float } $options = null)
 *
 * @method Page[] pages()
 *
 * @method-extended Page[] pages()
 *
 * @method bool isIncognito()
 *
 * @method-extended bool isIncognito()
 *
 * @method void overridePermissions(string $origin, mixed[] $permissions)
 *
 * @method-extended void overridePermissions(string $origin, mixed[] $permissions)
 *
 * @method void clearPermissionOverrides()
 *
 * @method-extended void clearPermissionOverrides()
 *
 * @method Page newPage()
 *
 * @method-extended Page newPage()
 *
 * @method Browser browser()
 *
 * @method-extended Browser browser()
 *
 * @method void close()
 *
 * @method-extended void close()
 */
class BrowserContext extends EventEmitter {}
