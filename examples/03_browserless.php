<?php

require __DIR__ . '/../vendor/autoload.php';

use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Data\JsFunction;
use Symfony\Component\Console\Output\ConsoleOutput;

// TIMEOUT=-1 dont work properly
$dockerId = `docker run --rm -d -p 3000:3000 --platform=linux/amd64 -e "TOKEN=abc" -e "TIMEOUT=-1" --name=chrome ghcr.io/browserless/chrome:v2.37.0`;

echo "Started browserless with id $dockerId" . PHP_EOL;
sleep(2);

try {
    $puppeteer = new Puppeteer([
        'js_extra' => /** @lang JavaScript */ "
            const puppeteer = require('puppeteer-extra');
            const StealthPlugin = require('puppeteer-extra-plugin-stealth');
            puppeteer.use(StealthPlugin());
            instruction.setDefaultResource(puppeteer);
        ",
        'idle_timeout' => 90,
        'read_timeout' => 120,
        'log_browser_console' => true,
        'log_node_console' => true,
        'logger' => new Symfony\Component\Console\Logger\ConsoleLogger(new ConsoleOutput(\Symfony\Component\Console\Output\OutputInterface::VERBOSITY_VERY_VERBOSE)),
    ]);

    $options = [
        'timeout' => 120000,
        'token' => 'abc',
        'launch' => json_encode([
            'headless' => false,
            'stealth'=> true,
            'timeout'=> 600_000,
            'args' => [
                '--window-size=1366,768',
                '--lang=ru-RU',
                '--incognito',
                '--0',
            ],
        ], JSON_UNESCAPED_UNICODE),
        'blockAds' => 'false',
    ];

    $browser = $puppeteer->connect([
        'browserWSEndpoint' => sprintf(
            'ws://127.0.0.1:3000/chrome?%s',
            http_build_query($options)
        ),
        'ignoreHTTPSErrors' => true,
        'ignoreDefaultArgs' => true,
    ]);
    $page = $browser->newPage();
    $page->setViewport(['width' => 1366, 'height' => 768]);
    $page->goto('https://bot.sannysoft.com', ['timeout' => 10_000, 'waitUntil' => 'domcontentloaded']);
    $page->waitForNetworkIdle(['idleTime' => 1_000, 'concurrency' => 1]);


    // Get the "viewport" of the page, as reported by the page.
    $dimensions = $page->evaluate(JsFunction::createWithBody(/** @lang JavaScript */"
        return {
            width: document.documentElement.clientWidth,
            height: document.documentElement.clientHeight,
            deviceScaleFactor: window.devicePixelRatio
        };
    "));

    printf('Dimensions: %s', print_r($dimensions, true));

    $page->screenshot(['path' => 'example_browserless.png', "fullPage" => true]);

    $browser->close();
} finally {
    `docker stop $dockerId`;
}
