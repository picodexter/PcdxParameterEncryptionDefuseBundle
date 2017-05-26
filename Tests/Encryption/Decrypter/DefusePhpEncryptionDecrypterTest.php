<?php

/*
 * This file is part of the PcdxParameterEncryptionDefuseBundle package.
 *
 * (c) picodexter <https://picodexter.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picodexter\ParameterEncryptionDefuseBundle\Tests\Encryption\Decrypter;

use Defuse\Crypto\Exception\CryptoException;
use Defuse\Crypto\Key;
use Picodexter\ParameterEncryptionDefuseBundle\Encryption\Algorithm\DefusePhpEncryption\CryptoProxyInterface;
use Picodexter\ParameterEncryptionDefuseBundle\Encryption\Algorithm\DefusePhpEncryption\KeyProxyInterface;
use Picodexter\ParameterEncryptionDefuseBundle\Encryption\Decrypter\DefusePhpEncryptionDecrypter;
use Picodexter\ParameterEncryptionDefuseBundle\Tests\Encryption\Algorithm\DefusePhpEncryption\CreateKeyDummyTrait;

class DefusePhpEncryptionDecrypterTest extends \PHPUnit_Framework_TestCase
{
    use CreateKeyDummyTrait;

    /**
     * @var CryptoProxyInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $cryptoProxy;

    /**
     * @var DefusePhpEncryptionDecrypter
     */
    private $decrypter;

    /**
     * @var KeyProxyInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $keyProxy;

    /**
     * PHPUnit: setUp.
     */
    public function setUp()
    {
        $this->cryptoProxy = $this->createCryptoProxyInterfaceMock();
        $this->keyProxy = $this->createKeyProxyInterfaceMock();

        $this->decrypter = new DefusePhpEncryptionDecrypter($this->cryptoProxy, $this->keyProxy);
    }

    /**
     * PHPUnit: tearDown.
     */
    public function tearDown()
    {
        $this->decrypter = null;
        $this->keyProxy = null;
        $this->cryptoProxy = null;
    }

    /**
     * @expectedException \Picodexter\ParameterEncryptionBundle\Exception\Encryption\DecrypterException
     */
    public function testDecryptValueExceptionCryptoProxyError()
    {
        $encryptedValue = 'encrypted value';
        $decryptionKey = 'secret key';
        $key = $this->createKeyDummy();

        $this->setUpKeyProxyLoadFromAsciiSafeString($decryptionKey, $key);

        $this->cryptoProxy->expects($this->once())
            ->method('decrypt')
            ->with(
                $this->identicalTo($encryptedValue),
                $this->identicalTo($key)
            )
            ->will($this->throwException(new CryptoException()));

        $this->decrypter->decryptValue($encryptedValue, $decryptionKey);
    }

    /**
     * @expectedException \Picodexter\ParameterEncryptionBundle\Exception\Encryption\DecrypterException
     */
    public function testDecryptValueExceptionKeyProxyError()
    {
        $encryptedValue = 'encrypted value';
        $decryptionKey = 'secret key';

        $this->keyProxy->expects($this->once())
            ->method('loadFromAsciiSafeString')
            ->with($this->identicalTo($decryptionKey))
            ->will($this->throwException(new CryptoException()));

        $this->decrypter->decryptValue($encryptedValue, $decryptionKey);
    }

    public function testDecryptValueSuccessWithDecryptionKey()
    {
        $preparedValue = 'decrypted value';

        $encryptedValue = 'encrypted value';
        $decryptionKey = 'secret key';
        $key = $this->createKeyDummy();

        $this->setUpKeyProxyLoadFromAsciiSafeString($decryptionKey, $key);

        $this->setUpCryptoProxyDecrypt($encryptedValue, $key, $preparedValue);

        $decryptedValue = $this->decrypter->decryptValue($encryptedValue, $decryptionKey);

        $this->assertSame($preparedValue, $decryptedValue);
    }

    public function testDecryptValueSuccessWithoutDecryptionKey()
    {
        $preparedValue = 'decrypted value';

        $encryptedValue = 'encrypted value';
        $key = $this->createKeyDummy();

        $this->setUpKeyProxyLoadFromAsciiSafeString(null, $key);

        $this->setUpCryptoProxyDecrypt($encryptedValue, $key, $preparedValue);

        $decryptedValue = $this->decrypter->decryptValue($encryptedValue);

        $this->assertSame($preparedValue, $decryptedValue);
    }

    /**
     * Create mock for CryptoProxyInterface.
     *
     * @return CryptoProxyInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private function createCryptoProxyInterfaceMock()
    {
        return $this->getMockBuilder(CryptoProxyInterface::class)->getMock();
    }

    /**
     * Create mock for KeyProxyInterface.
     *
     * @return KeyProxyInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private function createKeyProxyInterfaceMock()
    {
        return $this->getMockBuilder(KeyProxyInterface::class)->getMock();
    }

    /**
     * Set up CryptoProxy: decrypt.
     *
     * @param string $encryptedValue
     * @param Key    $key
     * @param string $preparedValue
     */
    private function setUpCryptoProxyDecrypt($encryptedValue, Key $key, $preparedValue)
    {
        $this->cryptoProxy->expects($this->once())
            ->method('decrypt')
            ->with(
                $this->identicalTo($encryptedValue),
                $this->identicalTo($key)
            )
            ->will($this->returnValue($preparedValue));
    }

    /**
     * Set up KeyProxy: loadFromAsciiSafeString.
     *
     * @param string $decryptionKey
     * @param Key    $key
     */
    private function setUpKeyProxyLoadFromAsciiSafeString($decryptionKey, Key $key)
    {
        $this->keyProxy->expects($this->once())
            ->method('loadFromAsciiSafeString')
            ->with($this->identicalTo($decryptionKey))
            ->will($this->returnValue($key));
    }
}
