
# PHP Utils

[![Latest Stable Version](https://poser.pugx.org/alphayax/php_utils/v/stable)](https://packagist.org/packages/alphayax/php_utils)
[![Total Downloads](https://poser.pugx.org/alphayax/php_utils/downloads)](https://packagist.org/packages/alphayax/php_utils)
[![Latest Unstable Version](https://poser.pugx.org/alphayax/php_utils/v/unstable)](https://packagist.org/packages/alphayax/php_utils)
[![License](https://poser.pugx.org/alphayax/php_utils/license)](https://packagist.org/packages/alphayax/php_utils)
[![Travis](https://travis-ci.org/alphayax/php_utils.svg)](https://travis-ci.org/alphayax/php_utils)

A set of PHP utilities class

## Rest

A tiny class using curl in oriented style

```php
$rest = new \alphayax\utils\Rest( 'https://api.github.com/users/alphayax/repos');
$rest->addHeader( 'User-Agent', 'alphayax-php_utils');
$rest->GET();

print_r( $rest->getCurlResponse());
```

## Cli

### GetOpt

A class to parse parameters given to a script

### IO

A class to provide stdout & stderr functions with color
