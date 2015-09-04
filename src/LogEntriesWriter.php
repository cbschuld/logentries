<?php
namespace cbschuld;

abstract class LogEntriesWriter
{
    /**
     * Simple Writer abstraction for adding a "middleware" message writer to the logger
     * @param array|string $message
     * @param boolean $isJson true if the message text is a json encoded value otherwise false
     * @return string updated log message (where message can be an array or a string)
     */
    public function log($message,$isJson=false) {
        return $message;
    }
}