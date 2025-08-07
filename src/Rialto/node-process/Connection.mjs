"use strict";

import EventEmitter from "events";
import ConnectionDelegate from "./ConnectionDelegate.mjs";
import ResourceRepository from "./Data/ResourceRepository.mjs";
import DataSerializer from "./Data/Serializer.mjs";
import DataUnserializer from "./Data/Unserializer.mjs";
import Instruction from "./Instruction.mjs";
import Logger from "./Logger.mjs";

/**
 * Handle a connection interacting with this process.
 */
export default class Connection extends EventEmitter {
    /**
     * Constructor.
     *
     * @param  {net.Socket} socket
     * @param  {ConnectionDelegate} delegate
     */
    constructor(socket, delegate) {
        super();

        this.socket = this.configureSocket(socket);

        this.delegate = delegate;

        this.resources = new ResourceRepository();

        this.dataSerializer = new DataSerializer(this.resources);
        this.dataUnserializer = new DataUnserializer(this.resources);
    }

    /**
     * Configure the socket for communication.
     *
     * @param  {net.Socket} socket
     * @return {net.Socket}
     */
    configureSocket(socket) {
        socket.setEncoding("utf8");
        let buffer = "";
        socket.on("data", (data) => {
            this.emit("activity");

            buffer += data;
            if (buffer.endsWith("\0")) {
                buffer = buffer.slice(0, -1);
                this.handleSocketData(buffer);
                buffer = "";
            }
        });

        return socket;
    }

    /**
     * Handle data received on the socket.
     *
     * @param  {string} data
     */
    handleSocketData(data) {
        const instruction = new Instruction(JSON.parse(data), this.resources, this.dataUnserializer);
        const { responseHandler, errorHandler } = this.createInstructionHandlers();

        this.delegate.handleInstruction(instruction, responseHandler, errorHandler);
    }

    /**
     * Generate response and errors handlers.
     *
     * @return {Object}
     */
    createInstructionHandlers() {
        let handlerHasAlreadyBeenCalled = false;

        const handler = (serializingMethod, value) => {
            if (handlerHasAlreadyBeenCalled) {
                throw new Error("Attempted to call an instruction handler twice.", {
                    cause: "Only the response OR error handler can be called (not both) and it cannot be called twice.",
                });
            }

            // Only allow a single handler to be called for an instruction
            handlerHasAlreadyBeenCalled = true;

            this.writeToSocket(
                JSON.stringify({
                    logs: Logger.logs(),
                    value: this[serializingMethod](value),
                }),
            );
        };

        // Return response and error handlers after binding the serializingMethod parameter appropriately
        return {
            responseHandler: handler.bind(this, "serializeValue"),
            errorHandler: handler.bind(this, "serializeError"),
        };
    }

    /**
     * Write a string to the socket
     *
     * @param  {string} str
     */
    writeToSocket(str) {
        const payload = Buffer.from(str);
        const payloadLength = Buffer.alloc(4);
        payloadLength.writeUInt32BE(payload.length);

        this.socket.write(Buffer.concat([payloadLength, payload]));
    }

    /**
     * Serialize a value to return to the client.
     *
     * @param  {*} value
     * @return {Object}
     */
    serializeValue(value) {
        return this.dataSerializer.serialize(value);
    }

    /**
     * Serialize an error to return to the client.
     *
     * @param  {Error} error
     * @return {Object}
     */
    serializeError(error) {
        return DataSerializer.serializeError(error);
    }
}
