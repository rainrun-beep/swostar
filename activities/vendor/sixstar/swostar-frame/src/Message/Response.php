<?php
namespace SwoStar\Message;

/**
 *
 */
class Response
{
    public static function send($message)
    {
        if (\is_array($message)) {
            return json_encode($message);
        } else if (\is_string($message)) {
            return $message;
        } else {
            return $message;
        }
    }
}
