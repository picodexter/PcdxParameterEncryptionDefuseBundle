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

use Defuse\Crypto\Exception\BadFormatException;
use Defuse\Crypto\Exception\EnvironmentIsBrokenException;
use Defuse\Crypto\Key;

/**
 * KeyDummyInterface.
 */
interface KeyDummyInterface
{
    /**
     * Creates new random key.
     *
     * @throws EnvironmentIsBrokenException
     *
     * @return Key
     */
    public static function createNewRandomKey();

    /**
     * Loads a Key from its encoded form.
     *
     * By default, this function will call Encoding::trimTrailingWhitespace()
     * to remove trailing CR, LF, NUL, TAB, and SPACE characters, which are
     * commonly appended to files when working with text editors.
     *
     * @param string $saved_key_string
     * @param bool $do_not_trim (default: false)
     *
     * @throws BadFormatException
     * @throws EnvironmentIsBrokenException
     *
     * @return Key
     */
    public static function loadFromAsciiSafeString($saved_key_string, $do_not_trim = false);

    /**
     * Encodes the Key into a string of printable ASCII characters.
     *
     * @throws EnvironmentIsBrokenException
     *
     * @return string
     */
    public static function saveToAsciiSafeString();

    /**
     * Gets the raw bytes of the key.
     *
     * @return string
     */
    public static function getRawBytes();
}
