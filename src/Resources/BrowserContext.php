<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\JsFunction;

/**
 * @property-read bool $closed
 * @property-read string|null $id
 * @method Target[] targets()
 * @method-extended Target[] targets()
 * @method mixed startScreenshot()
 * @method-extended mixed startScreenshot()
 * @method mixed|null waitForScreenshotOperations()
 * @method-extended mixed|null waitForScreenshotOperations()
 * @method Target waitForTarget(\Nesk\Puphpeteer\Rialto\Data\JsFunction $predicate, array $options = [])
 * @method-extended Target waitForTarget(callable(Target $x): bool|Promise|bool[]|\Nesk\Puphpeteer\Rialto\Data\JsFunction $predicate, array<string, mixed> $options = null)
 * @method Page[] pages()
 * @method-extended Page[] pages()
 * @method void overridePermissions(string $origin, mixed[] $permissions)
 * @method-extended void overridePermissions(string $origin, mixed[] $permissions)
 * @method void clearPermissionOverrides()
 * @method-extended void clearPermissionOverrides()
 * @method Page newPage()
 * @method-extended Page newPage()
 * @method Browser browser()
 * @method-extended Browser browser()
 * @method void close()
 * @method-extended void close()
 * @method mixed[] cookies()
 * @method-extended mixed[] cookies()
 * @method void setCookie(mixed ...$cookies)
 * @method-extended void setCookie(mixed ...$cookies)
 * @method void deleteCookie(mixed ...$cookies)
 * @method-extended void deleteCookie(mixed ...$cookies)
 */
class BrowserContext extends EventEmitter {}
