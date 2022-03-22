<?php

/**
 * Base Exception used across StageHub
 */
class BaseException extends Exception {
    // representing the custom string object
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

/**
 * Thrown when an invalid amount of parameters are passed to a function
 */
class MissingParamsException extends BaseException {}
