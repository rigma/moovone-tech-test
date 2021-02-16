# moovone-tech-test

This is a PHP script written for a technical test during an interview with
[MoovOne], a french company providing coaching solutions to big companies.

The goal of the test is to simulate a world composed of _cells_ which can
either be _excited_ or _quiet_. Each _cell_ is connected to her neighbors
and communicate with them by sending messages, if the _cell_ is excited.

This simulated world is evolving by steps and at each step a _cell_ can:

- become _quiet_ if it has received **no** messages or **two** messages from excited cells
- become _excited_ if it has received exactly **one** message from an excited
cell

## Usage

To use this script, you'll need to have at least [PHP 8] and [Composer]
installed on your computer. You also need to clone this repository on it
too.

First, you'll need to dump the autoload of `composer` by typing the following command:

```sh
$ composer dump-autoload
```

This will creates a `vendor` directory with an autoloading script in it which
will be used by the script.

Then, to use the script, you just have enter, for instance, this command:

```sh
$ php excited-cells -K 3 --world 1,1,0,0,0,0
1,1,1,0,0,1
```

To see further uses, you can ask for the help:

```sh
$ php excited-cells -h
```

## Test

This project comes with test cases made with [PHPUnit]. In order to execute
them, you'll have to install dev dependencies thanks to:

```sh
$ composer install
```

Then, you can use the composer script `test` to execute the unit tests of the
project.

## Copyright

This code is unlicensed and can be used however you want it. See [UNLICENSE] for further details.

[MoovOne]: https://www.moovone.eu
[PHP 8]: https://www.php.net/releases/8.0/en.php
[Composer]: https://getcomposer.org
[PHPUnit]: https://phpunit.de/
[UNLICENSE]: ./UNLICENSE
