<?php

/*
 * This file is part of the PcdxParameterEncryptionDefuseBundle package.
 *
 * (c) picodexter <https://picodexter.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picodexter\ParameterEncryptionDefuseBundle\Tests;

use Picodexter\ParameterEncryptionDefuseBundle\PcdxParameterEncryptionDefuseBundle;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;

class PcdxParameterEncryptionDefuseBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorSuccess()
    {
        $bundle = new PcdxParameterEncryptionDefuseBundle();

        $this->assertInstanceOf(BundleInterface::class, $bundle);
    }
}
