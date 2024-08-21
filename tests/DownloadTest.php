<?php

declare(strict_types=1);

namespace Nesk\Puphpeteer\Tests;

use PHPUnit\Framework\Attributes\Test;

class DownloadTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // Serve the content of the "/resources"-folder to test these.
        $this->serveResources();

        // Launch the browser to run tests on.
        $this->launchBrowser();
    }

    /**
     * Downloads an image and checks string length.
     */
    #[Test]
    public function download_image()
    {
        // Download the image
        $page = $this->browser->newPage()->goto($this->url . '/puphpeteer-logo.png');

        $base64 = $page->buffer()->toString('base64');
        $imageString = base64_decode($base64);

        // Get the reference image from resources
        $reference = file_get_contents('tests/resources/puphpeteer-logo.png');

        $this->assertTrue(
            mb_strlen($reference) === mb_strlen($imageString),
            'Image is not the same length after download.',
        );
    }

    // /**
    //  * Downloads an image and checks string length.
    //  */
    // #[Test]
    // public function download_large_image()
    // {
    //     // Download the image
    //     $page = $this->browser
    //         ->newPage()
    //         ->goto($this->url . '/denys-barabanov-jKcFmXCfaQ8-unsplash.jpg');
    //
    //     $base64 = $page->buffer()->toString('base64');
    //     $imageString = base64_decode($base64);
    //
    //     // Get the reference image from resources
    //     $reference = file_get_contents('tests/resources/denys-barabanov-jKcFmXCfaQ8-unsplash.jpg');
    //
    //     $this->assertTrue(
    //         mb_strlen($reference) === mb_strlen($imageString),
    //         'Large image is not the same length after download.'
    //     );
    // }
}
