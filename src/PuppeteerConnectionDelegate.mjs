"use strict";

import ConnectionDelegate from "./Rialto/node-process/ConnectionDelegate.mjs";
import Logger from "./Rialto/node-process/Logger.mjs";
import ConsoleInterceptor from "./Rialto/node-process/NodeInterceptors/ConsoleInterceptor.mjs";
import StandardStreamsInterceptor from "./Rialto/node-process/NodeInterceptors/StandardStreamsInterceptor.mjs";

import puppeteer from "puppeteer-core";
/**
 * Handle the requests of a connection to control Puppeteer.
 */
export default class PuppeteerConnectionDelegate extends ConnectionDelegate {
    /**
     * Constructor.
     *
     * @param  {Object} options
     */
    constructor(options) {
        super(options);

        this.browsers = new Set();

        this.addSignalEventListeners();
    }

    /**
     * @inheritdoc
     */
    async handleInstruction(instruction, responseHandler, errorHandler) {
        if (this.options.js_extra) {
            eval(this.options.js_extra);
        } else {
            instruction.setDefaultResource(puppeteer);
        }

        let value = null;
        try {
            value = await instruction.execute();
        } catch (error) {
            if (instruction.shouldCatchErrors()) {
                return errorHandler(error);
            }

            throw error;
        }

        if (this.isInstanceOf(value, "Browser")) {
            this.browsers.add(value);

            if (this.options.log_browser_console === true) {
                (await value.pages()).forEach((page) => page.on("console", this.logConsoleMessage));
            }
        }

        if (this.options.log_browser_console === true && this.isInstanceOf(value, "Page")) {
            value.on("console", this.logConsoleMessage);
        }

        responseHandler(value);
    }

    /**
     * Checks if a value is an instance of a class. The check must be done with the `[object].constructor.name`
     * property because relying on Puppeteer's constructors is not viable since the exports aren't constrained by semver.
     *
     * @protected
     * @param  {*} value
     * @param  {string} className
     *
     * @see {@link https://github.com/GoogleChrome/puppeteer/issues/3067|Puppeteer's issue about semver on exports}
     */
    isInstanceOf(value, className) {
        const isInstance =
            // constructor name exists
            value?.constructor?.name !== undefined &&
            // constructor name matches ${className} exactly
            (value.constructor.name === className ||
                // constructor name prefixed by a version of "CDP" or "Cdp" matches ${className}
                (value.constructor.name.toUpperCase().startsWith("CDP") &&
                    value.constructor.name.substring(3) === className));

        return isInstance;
    }

    /**
     * Log the console message.
     *
     * @param  {ConsoleMessage} consoleMessage
     */
    async logConsoleMessage(consoleMessage) {
        const type = consoleMessage.type();

        if (!ConsoleInterceptor.typeIsSupported(type)) {
            return;
        }

        const level = ConsoleInterceptor.getLevelFromType(type);
        const args = await Promise.all(consoleMessage.args().map((arg) => arg.jsonValue()));

        StandardStreamsInterceptor.startInterceptingStrings((message) => {
            Logger.log("Browser", level, ConsoleInterceptor.formatMessage(message));
        });

        ConsoleInterceptor.originalConsole[type](...args);

        StandardStreamsInterceptor.stopInterceptingStrings();
    }

    /**
     * Listen for process signal events.
     *
     * @protected
     */
    addSignalEventListeners() {
        for (let eventName of ["SIGINT", "SIGTERM", "SIGHUP"]) {
            process.on(eventName, () => {
                this.closeAllBrowsers();
                process.exit();
            });
        }
    }

    /**
     * Close all the browser instances when the process exits.
     *
     * Calling this method before exiting Node is mandatory since Puppeteer doesn't seem to handle that properly.
     *
     * @protected
     */
    closeAllBrowsers() {
        for (let browser of this.browsers.values()) {
            browser.close();
        }
    }
}