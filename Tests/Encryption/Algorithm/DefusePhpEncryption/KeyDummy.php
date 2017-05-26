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

/**
 * KeyDummy.
 */
class KeyDummy implements KeyDummyInterface
{
    use CreateKeyDummyTrait;

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
    public static function createNewRandomKey()
    {
        return self::createKeyDummyStatic();
    }

    /**
     * @inheritDoc
     */
    public static function loadFromAsciiSafeString($saved_key_string, $do_not_trim = false)
    {
        self::$lastMethodCalled = 'loadFromAsciiSafeString';
        self::$lastCallArguments = func_get_args();

        return self::createKeyDummyStatic();
    }

    /**
     * @inheritDoc
     */
    public static function saveToAsciiSafeString()
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public static function getRawBytes()
    {
        return '';
    }
}
