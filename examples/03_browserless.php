<?php

require __DIR__ . '/../vendor/autoload.php';

use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Data\JsFunction;

$puppeteer = new Puppeteer([
    'js_extra' => /** @lang JavaScript */ "
        const puppeteer = require('puppeteer-extra');
        const StealthPlugin = require('puppeteer-extra-plugin-stealth');
        puppeteer.use(StealthPlugin());
        instruction.setDefaultResource(puppeteer);
    "
]);

$options = [
    'launch' => json_encode([
        'headless' => false,
        'stealth'=> true,
        'timeout'=> 5000,
        'args' => [
            '--window-size=1366,768',
            '--incognito',
            '--0',
        ],
    ], JSON_UNESCAPED_UNICODE)
];

$browser = $puppeteer->connect([
    'browserWSEndpoint' => sprintf(
        'ws://127.0.0.1:3000/chrome?%s',
       http_build_query($options)
    )
]);
$page = $browser->newPage();
$page->setViewport(['width' => 1366, 'height' => 768]);
$page->goto('https://www.example.com');

// Get the "viewport" of the page, as reported by the page.
$dimensions = $page->evaluate(JsFunction::createWithBody(/** @lang JavaScript */"
    return {
        width: document.documentElement.clientWidth,
        height: document.documentElement.clientHeight,
        deviceScaleFactor: window.devicePixelRatio
    };
"));

printf('Dimensions: %s', print_r($dimensions, true));

$page->screenshot(['path' => 'example_browserless.png']);

$browser->close();