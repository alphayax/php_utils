
# PHP Utils

[![Latest Stable Version](https://poser.pugx.org/alphayax/php_utils/v/stable)](https://packagist.org/packages/alphayax/php_utils)
[![Latest Unstable Version](https://poser.pugx.org/alphayax/php_utils/v/unstable)](https://packagist.org/packages/alphayax/php_utils)
[![pakagist](https://img.shields.io/packagist/v/alphayax/php_utils.svg)](https://packagist.org/packages/alphayax/php_utils)

[![Travis](https://travis-ci.org/alphayax/php_utils.svg)](https://travis-ci.org/alphayax/php_utils)
[![Coverage Status](https://coveralls.io/repos/github/alphayax/php_utils/badge.svg?branch=master)](https://coveralls.io/github/alphayax/php_utils?branch=master)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/8bfe4b0f7bbb414b94502353e520cbac)](https://www.codacy.com/app/alphayax/php_utils?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=alphayax/php_utils&amp;utm_campaign=Badge_Grade)

[![License](https://poser.pugx.org/alphayax/php_utils/license)](https://packagist.org/packages/alphayax/php_utils)
[![Total Downloads](https://poser.pugx.org/alphayax/php_utils/downloads)](https://packagist.org/packages/alphayax/php_utils)

A set of PHP utilities class

## Rest

A tiny class using curl in object oriented style

```php
$rest = new \alphayax\utils\Rest( 'https://api.github.com/users/alphayax/repos');
$rest->addHeader( 'User-Agent', 'alphayax-php_utils');
$rest->GET();

print_r( $rest->getCurlResponse());
```

## Cli

### GetOpt

A class to parse parameters given to a script

```php
$Args = new GetOpt();
$Args->addShortOpt( 'v', 'Enable verbose mode');
$Args->addLongOpt( 'verbose'    , 'Enable verbose mode');
$Args->parse();

$isVerbose = $Args->hasOption( 'v') || $Args->hasOption( 'verbose');
```

### IO

A class to provide stdout & stderr functions with color

## File System

A set of classes for files and directories