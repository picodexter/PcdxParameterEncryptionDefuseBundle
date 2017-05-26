<?php

/*
 * This file is part of the PcdxParameterEncryptionDefuseBundle package.
 *
 * (c) picodexter <https://picodexter.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picodexter\ParameterEncryptionDefuseBundle\Encryption\Encrypter;

use Defuse\Crypto\Exception\CryptoException;
use Picodexter\ParameterEncryptionBundle\Encryption\Encrypter\EncrypterInterface;
use Picodexter\ParameterEncryptionBundle\Exception\Encryption\EncrypterException;
use Picodexter\ParameterEncryptionDefuseBundle\Encryption\Algorithm\DefusePhpEncryption\CryptoProxyInterface;
use Picodexter\ParameterEncryptionDefuseBundle\Encryption\Algorithm\DefusePhpEncryption\KeyProxyInterface;

/**
 * DefusePhpEncryptionDecrypter.
 */
class DefusePhpEncryptionEncrypter implements EncrypterInterface
{
    /**
     * @var CryptoProxyInterface
     */
    private $cryptoProxy;

    /**
     * @var KeyProxyInterface
     */
    private $keyProxy;

    /**
     * Constructor.
     *
     * @param CryptoProxyInterface $cryptoProxy
     * @param KeyProxyInterface    $keyProxy
     */
    public function __construct(CryptoProxyInterface $cryptoProxy, KeyProxyInterface $keyProxy)
    {
        $this->cryptoProxy = $cryptoProxy;
        $this->keyProxy = $keyProxy;
    }

    /**
     * @inheritDoc
     */
    public function encryptValue($plainValue, $encryptionKey = null)
    {
        try {
            $key = $this->keyProxy->loadFromAsciiSafeString($encryptionKey);

            $encryptedValue = $this->cryptoProxy->encrypt($plainValue, $key);
        } catch (CryptoException $e) {
            throw new EncrypterException($e);
        }

        return $encryptedValue;
    }
}
