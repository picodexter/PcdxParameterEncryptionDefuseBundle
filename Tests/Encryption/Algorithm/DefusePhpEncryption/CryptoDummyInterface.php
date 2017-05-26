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

use Defuse\Crypto\Exception\EnvironmentIsBrokenException;
use Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException;
use Defuse\Crypto\Key;

/**
 * CryptoDummyInterface.
 */
interface CryptoDummyInterface
{
    /**
     * Encrypts a string with a Key.
     *
     * @param string $plaintext
     * @param Key    $key
     * @param bool   $raw_binary
     *
     * @throws EnvironmentIsBrokenException
     *
     * @return string
     */
    public static function encrypt($plaintext, Key $key, $raw_binary = false);

    /**
     * Encrypts a string with a password, using a slow key derivation function
     * to make password cracking more expensive.
     *
     * @param string $plaintext
     * @param string $password
     * @param bool   $raw_binary
     *
     * @throws EnvironmentIsBrokenException
     *
     * @return string
     */
    public static function encryptWithPassword($plaintext, $password, $raw_binary = false);

    /**
     * Decrypts a ciphertext to a string with a Key.
     *
     * @param string $ciphertext
     * @param Key    $key
     * @param bool   $raw_binary
     *
     * @throws EnvironmentIsBrokenException
     * @throws WrongKeyOrModifiedCiphertextException
     *
     * @return string
     */
    public static function decrypt($ciphertext, Key $key, $raw_binary = false);

    /**
     * Decrypts a ciphertext to a string with a password, using a slow key
     * derivation function to make password cracking more expensive.
     *
     * @param string $ciphertext
     * @param string $password
     * @param bool   $raw_binary
     *
     * @throws EnvironmentIsBrokenException
     * @throws WrongKeyOrModifiedCiphertextException
     *
     * @return string
     */
    public static function decryptWithPassword($ciphertext, $password, $raw_binary = false);

    /**
     * Decrypts a legacy ciphertext produced by version 1 of this library.
     *
     * @param string $ciphertext
     * @param string $key
     *
     * @throws EnvironmentIsBrokenException
     * @throws WrongKeyOrModifiedCiphertextException
     *
     * @return string
     */
    public static function legacyDecrypt($ciphertext, $key);
}
