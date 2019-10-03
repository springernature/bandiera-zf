# Bandiera Zend Framework Integration

This integrates [bandiera](https://github.com/springernature/bandiera) for using feature flags in your applications. 

This module relies on the [bandiera PHP client](https://github.com/springernature/bandiera-client-php).

[![MIT licensed][shield-license]][info-license]

## Installation

Installation is done via [composer](https://getcomposer.org/). 


`composer require springernature/bandiera-zf`

Enable the module by adding the module to your `application.config.php`:

```php
return [
    'modules' => [
        // ...
        'SpringerNature\Zend\Bandiera',
        // ...
    ],
    // ...
```

Copy the sample config file [`springernature_bandiera.config.php`](config/springernature_bandiera.config.php) to your project.

## Usage

This module register into the service container a default client called `springernature.bandiera.client`.

```php
public function myService(Client $bandiera)
{
    if ($bandiera->isEnabled('my_app', 'feature') {
        // Do something
    }
}
```

This module also expose a `featureFlags` view helper. In a template the view helper can be used as following

```php
<?php if ($this->featureFlags('feature', ['param' => 'foo'])) : ?>
<?php endif; ?>
```



## Development

1. Fork this repo.
2. Run `composer install`
2. Run the tests `composer run-script tests`

## License

[&copy; 2019 Springer Nature](LICENSE.txt).

Bandiera Zend Framework Integration is licensed under the [MIT License][mit]. 

[mit]: http://opensource.org/licenses/mit-license.php
[info-license]: LICENSE
[info-build]: https://travis-ci.org/springernature/bandiera-zf
[shield-license]: https://img.shields.io/badge/license-MIT-blue.svg
[shield-build]: https://img.shields.io/travis/springernature/bandiera-zf/master.svg
