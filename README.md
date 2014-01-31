7digital API Bundle
===================

This bundle intends to integrate the [7digital API PHP client](https://github.com/gquemener/7digital-client) inside Symfony2.

Installation
------------

Add the following lines to your composer.json:

```json
{
    "require": {
        "gquemener/7digital-bundle": "dev-master@dev"
    }
}
```

And run `php composer.phar update gquemener/7digital-bundle`

Then, register the bundle in your kernel:

```php
# app/AppKernel.php

# ...

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            # ...
            new SevenDigital\SevenDigitalBundle(),
        );

        return $bundles;
    }
}
```

Configuration
-------------

```yaml
# app/config/config.yml

seven_digital:
    consumer_key: ...
    version: '1.2' # Or any other 7digital API version
    cache:         # A doctrine cache service id
```

Usage
-----

This bundle provides really basic integration of the 7digital API PHP client, through 5 services:

    - `7digital_api.client` The configured API client
    - `7digital_api.artist` The Artist service
    - `7digital_api.track` The Track service
    - `7digital_api.release` The Release service
    - `7digital_api.tag` The Tag service

Going Further
-------------

You can read more about available methods for each service on the [7digital API PHP client repository](https://github.com/gquemener/7digital-client) or on [7digital API Official documentation](http://developer.7digital.com/resources/api-docs/catalogue-api)
