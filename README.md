# weimark-php
[![Latest Version on Packagist](https://img.shields.io/packagist/v/repat/weimark-php.svg?style=flat-square)](https://packagist.org/packages/repat/weimark-php)
[![Total Downloads](https://img.shields.io/packagist/dt/repat/weimark-php.svg?style=flat-square)](https://packagist.org/packages/repat/weimark-php)

**weimark-php** is an API client for weimark.com webservice API. It's a private API, you need to contact them. This is an independent project with no official support, especially not from Weimark. You're welcome to open an issue or pull request though.

Based on ruby counterpart [davidred/weimark](https://github.com/davidred/weimark)

## Installation
`$ composer require repat/weimark-php`

## Documentation
### NewApplication
```php
// init
$w = new \Repat\Weimark\Client('email@provider.tld', 'secret_password', 'agent@email.tld');

// fill this out
$template = array_flip($w->getApplicationTemplate());
$template['fname'] = 'Joe';
// ...

$response = $w->newApplication($template);

// XML Response parsed as array
print_r($response);
```

### GetApplication
```php
// init
$w = new \Repat\Weimark\Client('email@provider.tld', 'secret_password', 'agent@email.tld');
$response = $w->getApplication('application_id');

// XML Response parsed as array
print_r($response);
```

## License
* MIT, see [LICENSE](https://github.com/repat/weimark-php/blob/master/LICENSE)

## Version
* Version 0.1

## Contact
#### repat
* Homepage: https://repat.de
* e-mail: repat@repat.de
* Twitter: [@repat123](https://twitter.com/repat123 "repat123 on twitter")

[![Flattr this git repo](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=repat&url=https://github.com/repat/weimark-php&title=weimark-php&language=&tags=github&category=software)
