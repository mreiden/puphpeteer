<?php

namespace Nesk\Puphpeteer\Resources;

/**
 * @property-read bool $connected
 * @property-read mixed $protocol
 * @property-read mixed $debugInfo
 * @method mixed|null process()
 * @method-extended mixed|null process()
 * @method \Nesk\Puphpeteer\Resources\BrowserContext createBrowserContext(array $options = [])
 * @method-extended \Nesk\Puphpeteer\Resources\BrowserContext createBrowserContext(array<string, mixed> $options = null)
 * @method \Nesk\Puphpeteer\Resources\BrowserContext[] browserContexts()
 * @method-extended \Nesk\Puphpeteer\Resources\BrowserContext[] browserContexts()
 * @method \Nesk\Puphpeteer\Resources\BrowserContext defaultBrowserContext()
 * @method-extended \Nesk\Puphpeteer\Resources\BrowserContext defaultBrowserContext()
 * @method string wsEndpoint()
 * @method-extended string wsEndpoint()
 * @method \Nesk\Puphpeteer\Resources\Page newPage()
 * @method-extended \Nesk\Puphpeteer\Resources\Page newPage()
 * @method \Nesk\Puphpeteer\Resources\Target[] targets()
 * @method-extended \Nesk\Puphpeteer\Resources\Target[] targets()
 * @method \Nesk\Puphpeteer\Resources\Target target()
 * @method-extended \Nesk\Puphpeteer\Resources\Target target()
 * @method \Nesk\Puphpeteer\Resources\Target waitForTarget(\Nesk\Rialto\Data\JsFunction $predicate, array $options = [])
 * @method-extended \Nesk\Puphpeteer\Resources\Target waitForTarget(callable(\Nesk\Puphpeteer\Resources\Target $x): bool|Promise|bool[]|\Nesk\Rialto\Data\JsFunction $predicate, array<string, mixed> $options = null)
 * @method \Nesk\Puphpeteer\Resources\Page[] pages()
 * @method-extended \Nesk\Puphpeteer\Resources\Page[] pages()
 * @method string version()
 * @method-extended string version()
 * @method string userAgent()
 * @method-extended string userAgent()
 * @method void close()
 * @method-extended void close()
 * @method void disconnect()
 * @method-extended void disconnect()
 * @method mixed[] cookies()
 * @method-extended mixed[] cookies()
 * @method void setCookie(mixed ...$cookies)
 * @method-extended void setCookie(mixed ...$cookies)
 * @method void deleteCookie(mixed ...$cookies)
 * @method-extended void deleteCookie(mixed ...$cookies)
 * @method void deleteMatchingCookies(mixed ...$filters)
 * @method-extended void deleteMatchingCookies(mixed ...$filters)
 * @method string installExtension(string $path)
 * @method-extended string installExtension(string $path)
 * @method void uninstallExtension(string $id)
 * @method-extended void uninstallExtension(string $id)
 * @method bool isConnected()
 * @method-extended bool isConnected()
 * @method bool isNetworkEnabled()
 * @method-extended bool isNetworkEnabled()
 */
class Browser extends EventEmitter
{
}
