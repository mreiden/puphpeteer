'use strict';

import manifest from "puppeteer-core/package.json" with { type: "json" };

function output(value) {
    process.stdout.write(JSON.stringify(value));
}

output(manifest.version);
