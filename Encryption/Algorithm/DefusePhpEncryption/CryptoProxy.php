<?php

/*
 * This file is part of the PcdxParameterEncryptionDefuseBundle package.
 *
 * (c) picodexter <https://picodexter.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picodexter\ParameterEncryptionDefuseBundle\Encryption\Algorithm\DefusePhpEncryption;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

/**
 * CryptoProxy.
 */
class CryptoProxy implements CryptoProxyInterface
{
    /**
     * @var string
     */
    private $fullyQualifiedClassName;

    /**
     * Constructor.
     *
     * @param string $completeClassName
     */
    public function __construct($completeClassName = Crypto::class)
    {
        $this->fullyQualifiedClassName = $completeClassName;
    }

    /**
     * @inheritDoc
     */
    public function decrypt($ciphertext, Key $key, $rawBinary = false)
    {
        return forward_static_call_array(
            [$this->fullyQualifiedClassName, 'decrypt'],
            [$ciphertext, $key, $rawBinary]
        );
    }

    /**
     * @inheritDoc
     */
    public function encrypt($plaintext, Key $key, $rawBinary = false)
    {
        return forward_static_call_array(
            [$this->fullyQualifiedClassName, 'encrypt'],
            [$plaintext, $key, $rawBinary]
        );
    }
}
