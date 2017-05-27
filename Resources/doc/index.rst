Getting Started With PcdxParameterEncryptionDefuseBundle
========================================================

This bundle is an add-on for the `PcdxParameterEncryptionBundle`_
and enables simple usage of it in combination with the Composer package
`defuse/php-encryption`_.

Prerequisites
-------------

You need Symfony 2.7+ with `PcdxParameterEncryptionBundle`_ already installed
and enabled (please refer to its own documentation).

Installation
------------

Step 1: Download the Bundle
~~~~~~~~~~~~~~~~~~~~~~~~~~~

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

.. code-block:: terminal

    $ composer require picodexter/parameter-encryption-defuse-bundle "~1"

This command requires you to have Composer installed globally, as explained
in the `installation chapter`_ of the Composer documentation.

Step 2: Enable the Bundle
~~~~~~~~~~~~~~~~~~~~~~~~~

Then, enable the bundle by adding it to the list of registered bundles
in the ``app/AppKernel.php`` file of your project:

.. code-block:: php

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

Step 3: Configuration
~~~~~~~~~~~~~~~~~~~~~

You can now use the following services in the PcdxParameterEncryptionBundle configuration:

* encrypter: ``pcdx_parameter_encryption_defuse.encryption.encrypter.defuse_php_encryption``
* decrypter: ``pcdx_parameter_encryption_defuse.encryption.decrypter.defuse_php_encryption``

Example:

1. Application configuration:

    .. configuration-block::

        .. code-block:: yaml

            # app/config/config.yml
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

        .. code-block:: xml

            <!-- app/config/config.xml -->
            <?xml version="1.0" encoding="UTF-8" ?>
            <container xmlns="http://symfony.com/schema/dic/services"
                xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                xmlns:ppe="https://picodexter.io/schema/dic/pcdx_parameter_encryption"
                xsi:schemaLocation="https://picodexter.io/schema/dic/pcdx_parameter_encryption
                    https://picodexter.io/schema/dic/pcdx_parameter_encryption/pcdx_parameter_encryption-1.0.xsd">

                <ppe:config>
                    <ppe:algorithm id="defuse">
                        <ppe:pattern type="value_prefix">
                            <ppe:argument>=#!PPE!defuse!#=</ppe:argument>
                        </ppe:pattern>
                        <ppe:encryption service="pcdx_parameter_encryption_defuse.encryption.encrypter.defuse_php_encryption"
                            key="%parameter_encryption.defuse.key%" />
                        <ppe:decryption service="pcdx_parameter_encryption_defuse.encryption.decrypter.defuse_php_encryption"
                            key="%parameter_encryption.defuse.key%" />
                    </ppe:algorithm>
                </ppe:config>
            </container>

        .. code-block:: php

            // app/config/config.php
            $container->loadFromExtension(
                'pcdx_parameter_encryption',
                [
                    'algorithms' => [
                        [
                            'id' => 'defuse',
                            'pattern' => [
                                'type' => 'value_prefix',
                                'arguments' => ['=#!PPE!defuse!#='],
                            ],
                            'encryption' => [
                                'service' => 'pcdx_parameter_encryption_defuse.encryption.encrypter.defuse_php_encryption',
                                'key' => '%parameter_encryption.defuse.key%',
                            ],
                            'decryption' => [
                                'service' => 'pcdx_parameter_encryption_defuse.encryption.decrypter.defuse_php_encryption',
                                'key' => '%parameter_encryption.defuse.key%',
                            ],
                        ],
                    ],
                ]
            );

2. Parameters:

    .. configuration-block::

        .. code-block:: yaml

            # app/config/parameters.yml
            parameters:
                parameter_encryption.defuse.key: 'YOUR_ENCRYPTION_KEY'

        .. code-block:: xml

            <!-- app/config/parameters.xml -->
            <?xml version="1.0" encoding="UTF-8" ?>
            <container xmlns="http://symfony.com/schema/dic/services"
                xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                xsi:schemaLocation="http://symfony.com/schema/dic/services
                    http://symfony.com/schema/dic/services/services-1.0.xsd">

                <parameters>
                    <parameter key="parameter_encryption.defuse.key">YOUR_ENCRYPTION_KEY</parameter>
                </parameters>
            </container>

        .. code-block:: php

            // app/config/parameters.php
            $container->setParameter('parameter_encryption.defuse.key', 'YOUR_ENCRYPTION_KEY');

    You can generate a random encryption key by using ``defuse/php-encryption``'s CLI tool:

    .. code-block:: terminal

        $ ./vendor/bin/generate-defuse-key

.. _PcdxParameterEncryptionBundle: https://github.com/picodexter/PcdxParameterEncryptionBundle
.. _defuse/php-encryption: https://github.com/defuse/php-encryption
.. _installation chapter: https://getcomposer.org/doc/00-intro.md
