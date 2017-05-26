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

use Defuse\Crypto\Key;

/**
 * CryptoDummy.
 */
class CryptoDummy implements CryptoDummyInterface
{
    /**
     * @var string
     */
    public static $lastMethodCalled = '';

    /**
     * @var array
     */
    public static $lastCallArguments = [];

    /**
     * @inheritDoc
     */
    public static function encrypt($plaintext, Key $key, $raw_binary = false)
    {
        self::$lastMethodCalled = 'encrypt';
        self::$lastCallArguments = func_get_args();

        return '';
    }

    /**
     * @inheritDoc
     */
    public static function encryptWithPassword($plaintext, $password, $raw_binary = false)
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public static function decrypt($ciphertext, Key $key, $raw_binary = false)
    {
        self::$lastMethodCalled = 'decrypt';
        self::$lastCallArguments = func_get_args();

        return '';
    }

    /**
     * @inheritDoc
     */
    public static function decryptWithPassword($ciphertext, $password, $raw_binary = false)
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public static function legacyDecrypt($ciphertext, $key)
    {
        return '';
    }
}
