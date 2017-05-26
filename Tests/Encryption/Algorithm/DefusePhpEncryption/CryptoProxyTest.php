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

use Picodexter\ParameterEncryptionDefuseBundle\Encryption\Algorithm\DefusePhpEncryption\CryptoProxy;

class CryptoProxyTest extends \PHPUnit_Framework_TestCase
{
    use CreateKeyDummyTrait;

    /**
     * @var CryptoProxy
     */
    private $proxy;

    /**
     * PHPUnit: setUp.
     */
    public function setUp()
    {
        $this->proxy = new CryptoProxy(CryptoDummy::class);
    }

    /**
     * PHPUnit: tearDown.
     */
    public function tearDown()
    {
        $this->proxy = null;
    }

    public function testDecryptSuccessWithoutRawBinary()
    {
        $ciphertext = 'some ciphertext';
        $key = $this->createKeyDummy();

        $this->proxy->decrypt($ciphertext, $key);

        $this->assertSame('decrypt', CryptoDummy::$lastMethodCalled);
        $this->assertSame(
            [$ciphertext, $key, false],
            CryptoDummy::$lastCallArguments
        );
    }

    public function testDecryptSuccessWithRawBinary()
    {
        $ciphertext = 'some ciphertext';
        $key = $this->createKeyDummy();
        $rawBinary = true;

        $this->proxy->decrypt($ciphertext, $key, $rawBinary);

        $this->assertSame('decrypt', CryptoDummy::$lastMethodCalled);
        $this->assertSame(
            [$ciphertext, $key, $rawBinary],
            CryptoDummy::$lastCallArguments
        );
    }

    public function testEncryptSuccessWithoutRawBinary()
    {
        $plaintext = 'some plaintext';
        $key = $this->createKeyDummy();

        $this->proxy->encrypt($plaintext, $key);

        $this->assertSame('encrypt', CryptoDummy::$lastMethodCalled);
        $this->assertSame(
            [$plaintext, $key, false],
            CryptoDummy::$lastCallArguments
        );
    }

    public function testEncryptSuccessWithRawBinary()
    {
        $plaintext = 'some plaintext';
        $key = $this->createKeyDummy();
        $rawBinary = true;

        $this->proxy->encrypt($plaintext, $key, $rawBinary);

        $this->assertSame('encrypt', CryptoDummy::$lastMethodCalled);
        $this->assertSame(
            [$plaintext, $key, $rawBinary],
            CryptoDummy::$lastCallArguments
        );
    }
}
