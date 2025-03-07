<?php

require __DIR__ . '/../vendor/autoload.php';

use Nesk\Puphpeteer\Puppeteer;

$puppeteer = new Puppeteer;
$browser = $puppeteer->connect(['browserWSEndpoint' => 'ws://127.0.0.1:3000/chrome']);

$page = $browser->newPage();
$page->setViewport(['width' => 1366, 'height' => 768]);
$page->goto('https://example.com');
$page->screenshot(['path' => 'example.png']);

$browser->close();