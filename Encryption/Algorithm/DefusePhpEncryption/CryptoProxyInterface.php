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

use Defuse\Crypto\Exception\EnvironmentIsBrokenException;
use Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException;
use Defuse\Crypto\Key;

/**
 * CryptoProxyInterface.
 */
interface CryptoProxyInterface
{
    /**
     * Decrypts a ciphertext to a string with a Key.
     *
     * @param string $ciphertext
     * @param Key    $key
     * @param bool   $rawBinary
     *
     * @throws EnvironmentIsBrokenException
     * @throws WrongKeyOrModifiedCiphertextException
     *
     * @return string
     */
    public function decrypt($ciphertext, Key $key, $rawBinary = false);

    /**
     * Encrypts a string with a Key.
     *
     * @param string $plaintext
     * @param Key    $key
     * @param bool   $rawBinary
     *
     * @throws EnvironmentIsBrokenException
     *
     * @return string
     */
    public function encrypt($plaintext, Key $key, $rawBinary = false);
}
