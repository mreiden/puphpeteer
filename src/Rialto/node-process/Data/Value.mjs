"use strict";

import { isString, isBoolean, isNull } from "es-toolkit";
import { isArray, isNumber, isPlainObject } from "es-toolkit/compat";

export default class Value {
    /**
     * Determine if the value is a string, a number, a boolean, or null.
     *
     * @param  {*} value
     * @return {boolean}
     */
    static isScalar(value) {
        return isString(value) || isNumber(value) || isBoolean(value) || isNull(value);
    }

    /**
     * Determine if the value is an array or a plain object.
     *
     * @param  {*} value
     * @return {boolean}
     */
    static isContainer(value) {
        return isArray(value) || isPlainObject(value);
    }

    /**
     * Map the values of a container.
     *
     * @param  {*} container
     * @param  {callback} mapper
     * @return {array}
     */
    static mapContainer(container, mapper) {
        if (isArray(container)) {
            return container.map(mapper);
        } else if (isPlainObject(container)) {
            return Object.entries(container).reduce((finalObject, [key, value]) => {
                finalObject[key] = mapper(value);

                return finalObject;
            }, {});
        } else {
            return container;
        }
    }

    /**
     * Determine if the value is a resource.
     *
     * @param  {*} value
     * @return {boolean}
     */
    static isResource(value) {
        return !Value.isContainer(value) && !Value.isScalar(value);
    }
}
