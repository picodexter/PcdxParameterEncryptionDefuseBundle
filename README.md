# PcdxParameterEncryptionDefuseBundle

## DEPRECATION WARNING!

### THIS BUNDLE IS NOW DEPRECATED / ABANDONED

The [Symfony Secrets management](https://symfony.com/doc/current/configuration/secrets.html)
that was introduced with Symfony 4.4 offers an official solution for the
original purpose of this bundle.

Please refer to it instead.

Active development on this project has therefore been stopped.

## END OF DEPRECATION WARNING

This bundle is an add-on for the
[PcdxParameterEncryptionBundle](https://github.com/picodexter/PcdxParameterEncryptionBundle)
and enables simple usage of it in combination with the Composer package
[defuse/php-encryption](https://github.com/defuse/php-encryption).

[![Latest Stable Version](https://img.shields.io/packagist/v/picodexter/parameter-encryption-defuse-bundle.svg?style=flat)](https://packagist.org/packages/picodexter/parameter-encryption-defuse-bundle)
[![Build Status](https://img.shields.io/travis/picodexter/PcdxParameterEncryptionDefuseBundle/master.svg?style=flat)](https://travis-ci.org/picodexter/PcdxParameterEncryptionDefuseBundle)
[![Code Coverage](https://img.shields.io/coveralls/picodexter/PcdxParameterEncryptionDefuseBundle/master.svg?style=flat)](https://coveralls.io/github/picodexter/PcdxParameterEncryptionDefuseBundle)

## Features

You will be able to use the following ciphers:

### Symmetric Ciphers

*   Defuse PHP encryption

    (proprietary, uses AES-128 for encryption and HMAC-SHA256 for authentication)

## Documentation

The documentation source files are located in the `Resources/doc/` directory of
this bundle.

## Installation

Please refer to the [Getting Started guide](Resources/doc/getting-started.rst).

## License

This bundle is released under the [MIT license](LICENSE).

## Authors

*   picodexter | [GitHub](https://github.com/picodexter) | [picodexter.io](https://picodexter.io/)

See also the [list of contributors](https://github.com/picodexter/PcdxParameterEncryptionDefuseBundle/contributors).

## Contributing

The official project repository with the issue tracker can be found
[on GitHub](https://github.com/picodexter/PcdxParameterEncryptionDefuseBundle).

Please refer to the [contributing document](CONTRIBUTING.md).
