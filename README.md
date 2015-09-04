# LogEntries
[![Build Status](https://travis-ci.org/cbschuld/logentries.svg?branch=master)](https://travis-ci.org/cbschuld/logentries)

A LogEntries specific logging class by [Chris Schuld](http://chrisschuld.com/) for logging information to [LogEntries](https://logentries.com)

## About

LogEntries is an easy-to-use PHP [PSR-3](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md)
compliant logging class used to log information to the [LogEntries](https://logentries.com) SaaS application.

## Installation

### Composer

From the Command Line:

```
composer require cbschuld/LogEntries:1.*
```

In your `composer.json`:

``` json
{
    "require": {
        "cbschuld/LogEntries": "1.*"
    }
}
```

## Basic Usage

``` php
<?php

use cbschuld\LogEntries;

require "vendor/autoload.php";
$token = "2bfbea1e-10c3-4419-bdad-7e6435882e1f"; // your LogEntries token (sample from docs)

$log = LogEntries::getLogger($token,true,true); // create persistent SSL-based connection
$log->info("some information");
$log->notice(json_encode(["status"=>"ok","message"=>"send some json"]));

```

## Advanced Usage

You can send all of the logging functions either a string (PSR-3), encoded JSON (PSR-3)
or an array which will be encoded into JSON (not PSR-3 but available)

``` php
<?php

use cbschuld\LogEntries;

require "vendor/autoload.php";
$token = "2bfbea1e-10c3-4419-bdad-7e6435882e1f"; // your LogEntries token (sample from docs)
$jsonInfo = ["json"=>true,"example"=>"yes","works"=>true];

$log = LogEntries::getLogger($token,true,true); // create persistent SSL-based connection
$log->info(["status"=>"ok","example"=>"with json messages"]);
$log->notice($jsonInfo);

```

You can also create a non-static instantiation for dependency injection or multiple log token usage

``` php
<?php

use cbschuld\LogEntries;

require "vendor/autoload.php";
$token = "2bfbea1e-10c3-4419-bdad-7e6435882e1f"; // your LogEntries token (sample from docs)
$jsonInfo = ["json"=>true,"example"=>"yes","works"=>true];

$log = new LogEntries($token,true,true); // create persistent SSL-based connection
$log->info(["status"=>"ok","example"=>"with json messages"]);
$log->notice($jsonInfo);

$token2 = "2bfbea1e-10c3-4419-bdad-7e6435882e1f"; // your LogEntries token (sample from docs)
$log2 = new LogEntries($token2,true,true); // create persistent SSL-based connection
$log2->info(["status"=>"ok","example"=>"with json messages","from"=>"log2"]);
$log2->notice($jsonInfo);

```

## Middleware (Writer)

Using a LogEntriesWriter you can append log writing middleware into the log.  The middleware is called before the log
is written to LogEntries.  It allows for sensing for JSON or text.  This allows you to append data from your
architecture into your logs.

Here is a sample usage:

``` php
<?php

use cbschuld\LogEntries;
use cbschuld\LogEntriesWriter;

class WriterTest extends LogEntriesWriter {
    // always add the hostname
    public function log($message,$isJson=false) {
        if($isJson) {
            $json = json_decode($message,true);
            $json["hostname"] = gethostname();
            $message = json_encode($json);
        }
        else {
            $hostname = gethostname();
            $message .= " hostname={$hostname}";
        }
        return $message;
    }
}

$writer = new WriterTest();

$json = array(
    "datetime" => new \DateTime("now"),
    "status" => "ok",
);
$log = new LogEntries("MYTOKEN",true,true);
$log->addWriter($writer);
$log->info($json);

```


## PSR-3 Compliant

LogEntries is PHP [PSR-3](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md)
compliant. This means it implements the `Psr\Log\LoggerInterface`.

[See Here for the interface definition.](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md#3-psrlogloggerinterface)


## License

The MIT License

Copyright (c) 2015 Chris Schuld <chris@chrisschuld.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.