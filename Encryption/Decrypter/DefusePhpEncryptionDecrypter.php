<?php

/*
 * This file is part of the PcdxParameterEncryptionDefuseBundle package.
 *
 * (c) picodexter <https://picodexter.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picodexter\ParameterEncryptionDefuseBundle\Encryption\Decrypter;

use Defuse\Crypto\Exception\CryptoException;
use Picodexter\ParameterEncryptionBundle\Encryption\Decrypter\DecrypterInterface;
use Picodexter\ParameterEncryptionBundle\Exception\Encryption\DecrypterException;
use Picodexter\ParameterEncryptionDefuseBundle\Encryption\Algorithm\DefusePhpEncryption\CryptoProxyInterface;
use Picodexter\ParameterEncryptionDefuseBundle\Encryption\Algorithm\DefusePhpEncryption\KeyProxyInterface;

/**
 * DefusePhpEncryptionDecrypter.
 */
class DefusePhpEncryptionDecrypter implements DecrypterInterface
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
    public function decryptValue($encryptedValue, $decryptionKey = null)
    {
        try {
            $key = $this->keyProxy->loadFromAsciiSafeString($decryptionKey);

            $decryptedValue = $this->cryptoProxy->decrypt($encryptedValue, $key);
        } catch (CryptoException $e) {
            throw new DecrypterException($e);
        }

        return $decryptedValue;
    }
}
