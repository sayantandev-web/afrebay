<?php

namespace OpenTok\Exception;

/**
* Defines an exception thrown when a call to a signal method results in an error response from
* the server.
*/
class SignalConnectionException extends DomainException implements SignalException
{
    /** @ignore */
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}
