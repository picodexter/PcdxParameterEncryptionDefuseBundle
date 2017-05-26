# PcdxParameterEncryptionDefuseBundle

This bundle is an add-on for the
[PcdxParameterEncryptionBundle](https://github.com/picodexter/PcdxParameterEncryptionBundle)
and enables simple usage of it in combination with the Composer package
[defuse/php-encryption](https://github.com/defuse/php-encryption).

[![Latest Stable Version](https://img.shields.io/packagist/v/picodexter/parameter-encryption-defuse-bundle.svg?style=flat)](https://packagist.org/packages/picodexter/parameter-encryption-defuse-bundle)
[![Build Status](https://img.shields.io/travis/picodexter/PcdxParameterEncryptionDefuseBundle/master.svg?style=flat)](https://travis-ci.org/picodexter/PcdxParameterEncryptionDefuseBundle)

## Installation

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require picodexter/parameter-encryption-defuse-bundle "~1"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Picodexter\ParameterEncryptionDefuseBundle\PcdxParameterEncryptionDefuseBundle(),
        );

        // ...
    }

    // ...
}
```

### Step 3: Configure

You can now use the following services in the PcdxParameterEncryptionBundle configuration:

* encrypter: `pcdx_parameter_encryption_defuse.encryption.encrypter.defuse_php_encryption`
* decrypter: `pcdx_parameter_encryption_defuse.encryption.decrypter.defuse_php_encryption`

Example:

1. Configuration (app/config/config.yml)

    ```yaml
    pcdx_parameter_encryption:
        algorithms:
            -   id: 'defuse'
                pattern:
                    type: 'value_prefix'
                    arguments:
                        -   '=#!PPE!defuse!#='
                encryption:
                    service: 'pcdx_parameter_encryption_defuse.encryption.encrypter.defuse_php_encryption'
                    key: '%parameter_encryption.defuse.key%'
                decryption:
                    service: 'pcdx_parameter_encryption_defuse.encryption.decrypter.defuse_php_encryption'
                    key: '%parameter_encryption.defuse.key%'
    ```

2. Parameters (app/config/parameters.yml)

    ```yaml
    parameters:
        parameter_encryption.defuse.key: '<your encryption key>'
    ```
    
    You can generate a random encryption key by using `defuse/php-encryption`'s CLI tool:
    
    ```shell
    ./vendor/bin/generate-defuse-key
    ```

## License

This bundle is released under the [MIT license](LICENSE).
