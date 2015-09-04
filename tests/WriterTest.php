<?php

namespace cbschuld\LogEntries\Tests;

use \cbschuld\LogEntriesWriter;

class WriterTest extends LogEntriesWriter {
    public function log($message,$isJson=false) {
        if($isJson) {
            $json = json_decode($message,true);
            $json["addon"] = "added some additional info";
            $message = json_encode($json);
        }
        else {
            $message .= " text added on to message from writer";
        }
        return $message;
    }
}
