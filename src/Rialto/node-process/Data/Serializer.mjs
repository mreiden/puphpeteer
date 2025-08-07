"use strict";

import Value from "./Value.mjs";

export default class Serializer {
    /**
     * Serialize an error to JSON.
     *
     * @param  {Error} error
     * @return {Object}
     */
    static serializeError(error) {
        return {
            __rialto_error__: true,
            message: error.message,
            stack: error.stack,
        };
    }

    /**
     * Constructor.
     *
     * @param  {ResourceRepository} resources
     */
    constructor(resources) {
        this.resources = resources;
    }

    /**
     * Serialize a value.
     *
     * @param  {*} value
     * @return {*}
     */
    serialize(value) {
        // Use null if value is undefined
        value ??= null;

        return Value.isContainer(value)
            ? Value.mapContainer(value, this.serialize.bind(this))
            : Value.isScalar(value)
                ? value
                : this.resources.store(value).serialize();
    }
}
