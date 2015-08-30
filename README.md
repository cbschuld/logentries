# LogEntries
A LogEntries specific logging class by [Chris Schuld](http://chrisschuld.com/) for logging information to [LogEntries](https://logentries.com)

## About

LogEntries is an easy-to-use PHP [PSR-3](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md)
compliant logging class used to log information to the [LogEntries](https://logentries.com) SaaS application.

## Installation

### Composer

From the Command Line:

```
composer require cbschuld/LogEntries:dev-master
```

In your `composer.json`:

``` json
{
    "require": {
        "cbschuld/LogEntries": "dev-master"
    }
}
```

## Basic Usage

``` php
<?php

require "vendor/autoload.php";
$token = "your_logentries_token";

$log = LogEntries::getLogger($token,true,true); // create persistent SSL-based connection
$log->info("some information");
$log->notice(json_encode(["status"=>"ok","message"=>"send some json"]));

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