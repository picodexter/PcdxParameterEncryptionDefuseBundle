<?php

/*
 * This file is part of the PcdxParameterEncryptionDefuseBundle package.
 *
 * (c) picodexter <https://picodexter.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picodexter\ParameterEncryptionDefuseBundle\Tests\DependencyInjection;

use Picodexter\ParameterEncryptionDefuseBundle\DependencyInjection\PcdxParameterEncryptionDefuseExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class PcdxParameterEncryptionDefuseExtensionIntegrationTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadSuccess()
    {
        $mergedConfig = [];
        $container = new ContainerBuilder();

        $extension = new PcdxParameterEncryptionDefuseExtension();

        $extension->load($mergedConfig, $container);

        $serviceDefinition = $container
            ->getDefinition('pcdx_parameter_encryption_defuse.encryption.decrypter.defuse_php_encryption');

        $this->assertInstanceOf(Definition::class, $serviceDefinition);
    }
}
