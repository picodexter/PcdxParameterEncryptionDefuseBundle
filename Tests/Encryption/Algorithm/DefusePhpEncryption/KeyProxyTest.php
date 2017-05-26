<?php

/*
 * This file is part of the PcdxParameterEncryptionDefuseBundle package.
 *
 * (c) picodexter <https://picodexter.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picodexter\ParameterEncryptionDefuseBundle\Tests\Encryption\Algorithm\DefusePhpEncryption;

use Picodexter\ParameterEncryptionDefuseBundle\Encryption\Algorithm\DefusePhpEncryption\KeyProxy;

class KeyProxyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var KeyProxy
     */
    private $proxy;

    /**
     * PHPUnit: setUp.
     */
    public function setUp()
    {
        $this->proxy = new KeyProxy(KeyDummy::class);
    }

    /**
     * PHPUnit: tearDown.
     */
    public function tearDown()
    {
        $this->proxy = null;
    }

    public function testLoadFromAsciiSafeStringSuccessWithDoNotTrim()
    {
        $savedKeyString = '1234567890ABCDEF';
        $doNotTrim = true;

        $this->proxy->loadFromAsciiSafeString($savedKeyString, $doNotTrim);

        $this->assertSame('loadFromAsciiSafeString', KeyDummy::$lastMethodCalled);
        $this->assertSame(
            [$savedKeyString, $doNotTrim],
            KeyDummy::$lastCallArguments
        );
    }

    public function testLoadFromAsciiSafeStringSuccessWithoutDoNotTrim()
    {
        $savedKeyString = '1234567890ABCDEF';

        $this->proxy->loadFromAsciiSafeString($savedKeyString);

        $this->assertSame('loadFromAsciiSafeString', KeyDummy::$lastMethodCalled);
        $this->assertSame(
            [$savedKeyString, false],
            KeyDummy::$lastCallArguments
        );
    }
}
