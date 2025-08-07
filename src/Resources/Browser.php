<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Resources;

use Nesk\Puphpeteer\Rialto\Data\JsFunction;

/**
 * @property-read bool $connected
 * @property-read mixed $protocol
 * @property-read mixed $debugInfo
 * @method mixed|null process()
 * @method-extended mixed|null process()
 * @method BrowserContext createBrowserContext(array $options = [])
 * @method-extended BrowserContext createBrowserContext(array<string, mixed> $options = null)
 * @method BrowserContext[] browserContexts()
 * @method-extended BrowserContext[] browserContexts()
 * @method BrowserContext defaultBrowserContext()
 * @method-extended BrowserContext defaultBrowserContext()
 * @method string wsEndpoint()
 * @method-extended string wsEndpoint()
 * @method Page newPage()
 * @method-extended Page newPage()
 * @method Target[] targets()
 * @method-extended Target[] targets()
 * @method Target target()
 * @method-extended Target target()
 * @method Target waitForTarget(\Nesk\Rialto\Data\JsFunction $predicate, array $options = [])
 * @method-extended Target waitForTarget(callable(Target $x): bool|Promise|bool[]|\Nesk\Rialto\Data\JsFunction $predicate, array<string, mixed> $options = null)
 * @method Page[] pages()
 * @method-extended Page[] pages()
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
 * @method string installExtension(string $path)
 * @method-extended string installExtension(string $path)
 * @method void uninstallExtension(string $id)
 * @method-extended void uninstallExtension(string $id)
 * @method bool isConnected()
 * @method-extended bool isConnected()
 */
class Browser extends EventEmitter {}
