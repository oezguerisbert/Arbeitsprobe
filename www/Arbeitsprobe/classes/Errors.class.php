<?php
abstract class Errors
{

    const messages = array(
        -1 => "UNKNOWN ERROR",
        23000 => "DUPLICATE ENTRY",
    );

    const EMAIL_OR_USER_EXISTS = "Please choose a different username/email.";

    function unknown($error)
    {
        return "There was an unknown error: <br />" . $error;
    }

    function cantUpdate($column, $value, $reason)
    {
        return "Can't update '$column' with $value. Reason: $reason!";
    }
    function get(int $code, $originalError)
    {
        if (isset(Errors::messages[$code])) {
            return Errors::messages[$code];
        }
        return Errors::messages[-1] . " => " . $originalError;
    }
}
