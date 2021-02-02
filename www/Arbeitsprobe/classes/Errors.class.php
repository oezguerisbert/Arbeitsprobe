<?php
abstract class Errors
{

    const messages = array(
        -1 => "UNKNOWN ERROR",
        23000 => "DUPLICATE ENTRY",
    );

    function get(int $code, $originalError)
    {
        if (isset(Errors::messages[$code])) {
            return Errors::messages[$code];
        }
        return Errors::messages[-1] . " => " . $originalError;
    }
}
