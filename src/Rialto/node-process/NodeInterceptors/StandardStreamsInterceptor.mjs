"use strict";

import { isString, isFunction } from "es-toolkit/compat";

const STANDARD_STREAMS = [process.stdout, process.stderr];

export default class StandardStreamsInterceptor {
    /**
     * Standard stream interceptor.
     *
     * @callback standardStreamInterceptor
     * @param  {string} message
     */

    /**
     *
     * @type {Map<any, any>}
     */
    static standardStreamWriters = new Map();

    /**
     * Start intercepting data written on the standard streams.
     *
     * @param  {standardStreamInterceptor} interceptor
     */
    static startInterceptingStrings(interceptor) {
        STANDARD_STREAMS.forEach((stream) => {
            this.standardStreamWriters.set(stream, stream.write);

            stream.write = (chunk, encoding, callback) => {
                if (isString(chunk)) {
                    interceptor(chunk);

                    if (isFunction(callback)) {
                        callback();
                    }

                    return true;
                }

                return stream.write(chunk, encoding, callback);
            };
        });
    }

    /**
     * Stop intercepting data written on the standard streams.
     */
    static stopInterceptingStrings() {
        STANDARD_STREAMS.forEach((stream) => {
            stream.write = this.standardStreamWriters.get(stream);
            this.standardStreamWriters.delete(stream);
        });
    }
}
