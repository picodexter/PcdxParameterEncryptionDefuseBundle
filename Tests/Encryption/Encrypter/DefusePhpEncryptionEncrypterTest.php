<?php

/*
 * This file is part of the PcdxParameterEncryptionDefuseBundle package.
 *
 * (c) picodexter <https://picodexter.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picodexter\ParameterEncryptionDefuseBundle\Tests\Encryption\Encrypter;

use Defuse\Crypto\Key;
use Exception;
use Picodexter\ParameterEncryptionDefuseBundle\Encryption\Algorithm\DefusePhpEncryption\CryptoProxyInterface;
use Picodexter\ParameterEncryptionDefuseBundle\Encryption\Algorithm\DefusePhpEncryption\KeyProxyInterface;
use Picodexter\ParameterEncryptionDefuseBundle\Encryption\Encrypter\DefusePhpEncryptionEncrypter;
use Picodexter\ParameterEncryptionDefuseBundle\Tests\Encryption\Algorithm\DefusePhpEncryption\CreateKeyDummyTrait;

class DefusePhpEncryptionEncrypterTest extends \PHPUnit_Framework_TestCase
{
    use CreateKeyDummyTrait;

    /**
     * @var CryptoProxyInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $cryptoProxy;

    /**
     * @var DefusePhpEncryptionEncrypter
     */
    private $encrypter;

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

        $this->encrypter = new DefusePhpEncryptionEncrypter($this->cryptoProxy, $this->keyProxy);
    }

    /**
     * PHPUnit: tearDown.
     */
    public function tearDown()
    {
        $this->encrypter = null;
        $this->keyProxy = null;
        $this->cryptoProxy = null;
    }

    /**
     * @expectedException \Picodexter\ParameterEncryptionBundle\Exception\Encryption\EncrypterException
     */
    public function testEncryptValueExceptionCryptoProxyError()
    {
        $plainValue = 'some plain value';
        $encryptionKey = 'secret key';
        $key = $this->createKeyDummy();

        $this->setUpKeyProxyLoadFromAsciiSafeString($encryptionKey, $key);

        $this->cryptoProxy->expects($this->once())
            ->method('encrypt')
            ->with(
                $this->identicalTo($plainValue),
                $this->identicalTo($key)
            )
            ->will($this->throwException(new Exception()));

        $this->encrypter->encryptValue($plainValue, $encryptionKey);
    }

    /**
     * @expectedException \Picodexter\ParameterEncryptionBundle\Exception\Encryption\EncrypterException
     */
    public function testEncryptValueExceptionKeyProxyError()
    {
        $plainValue = 'some plain value';
        $encryptionKey = 'secret key';

        $this->keyProxy->expects($this->once())
            ->method('loadFromAsciiSafeString')
            ->with($this->identicalTo($encryptionKey))
            ->will($this->throwException(new Exception()));

        $this->encrypter->encryptValue($plainValue, $encryptionKey);
    }

    public function testEncryptValueSuccess()
    {
        $preparedValue = 'encrypted value';

        $plainValue = 'some plain value';
        $encryptionKey = 'secret key';
        $key = $this->createKeyDummy();

        $this->setUpKeyProxyLoadFromAsciiSafeString($encryptionKey, $key);

        $this->cryptoProxy->expects($this->once())
            ->method('encrypt')
            ->with(
                $this->identicalTo($plainValue),
                $this->identicalTo($key)
            )
            ->will($this->returnValue($preparedValue));

        $encryptedValue = $this->encrypter->encryptValue($plainValue, $encryptionKey);

        $this->assertSame($preparedValue, $encryptedValue);
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
     * Set up KeyProxy: loadFromAsciiSafeString.
     *
     * @param string $encryptionKey
     * @param Key    $key
     */
    private function setUpKeyProxyLoadFromAsciiSafeString($encryptionKey, Key $key)
    {
        $this->keyProxy->expects($this->once())
            ->method('loadFromAsciiSafeString')
            ->with($this->identicalTo($encryptionKey))
            ->will($this->returnValue($key));
    }
}
