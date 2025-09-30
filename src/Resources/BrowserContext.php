<?php

namespace Nesk\Puphpeteer\Resources;

/**
 * @property-read bool $closed
 * @property-read string|null $id
 * @method \Nesk\Puphpeteer\Resources\Target[] targets()
 * @method-extended \Nesk\Puphpeteer\Resources\Target[] targets()
 * @method mixed startScreenshot()
 * @method-extended mixed startScreenshot()
 * @method mixed|null waitForScreenshotOperations()
 * @method-extended mixed|null waitForScreenshotOperations()
 * @method \Nesk\Puphpeteer\Resources\Target waitForTarget(\Nesk\Rialto\Data\JsFunction $predicate, array $options = [])
 * @method-extended \Nesk\Puphpeteer\Resources\Target waitForTarget(callable(\Nesk\Puphpeteer\Resources\Target $x): bool|Promise|bool[]|\Nesk\Rialto\Data\JsFunction $predicate, array<string, mixed> $options = null)
 * @method \Nesk\Puphpeteer\Resources\Page[] pages()
 * @method-extended \Nesk\Puphpeteer\Resources\Page[] pages()
 * @method void overridePermissions(string $origin, mixed[] $permissions)
 * @method-extended void overridePermissions(string $origin, mixed[] $permissions)
 * @method void clearPermissionOverrides()
 * @method-extended void clearPermissionOverrides()
 * @method \Nesk\Puphpeteer\Resources\Page newPage()
 * @method-extended \Nesk\Puphpeteer\Resources\Page newPage()
 * @method \Nesk\Puphpeteer\Resources\Browser browser()
 * @method-extended \Nesk\Puphpeteer\Resources\Browser browser()
 * @method void close()
 * @method-extended void close()
 * @method mixed[] cookies()
 * @method-extended mixed[] cookies()
 * @method void setCookie(mixed ...$cookies)
 * @method-extended void setCookie(mixed ...$cookies)
 * @method void deleteCookie(mixed ...$cookies)
 * @method-extended void deleteCookie(mixed ...$cookies)
 * @method void deleteMatchingCookies(mixed ...$filters)
 * @method-extended void deleteMatchingCookies(mixed ...$filters)
 */
class BrowserContext extends EventEmitter
{
}
