<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Data\JsFunction;

$puppeteer = new Puppeteer();

$browser = $puppeteer->launch();
$page = $browser->newPage();
$page->goto('https://example.com/');

// Get the "viewport" of the page, as reported by the page.
$javascript = <<<'JSFUNC'
/** @lang JavaScript */"
return {
    width: document.documentElement.clientWidth,
    height: document.documentElement.clientHeight,
    deviceScaleFactor: window.devicePixelRatio
};
JSFUNC;
$dimensions = $page->evaluate(JsFunction::createWithBody($javascript));

printf('Dimensions: %s', print_r($dimensions, true));

$browser->close();
