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

use Defuse\Crypto\Exception\BadFormatException;
use Defuse\Crypto\Exception\EnvironmentIsBrokenException;
use Defuse\Crypto\Key;

/**
 * KeyProxyInterface.
 */
interface KeyProxyInterface
{
    /**
     * Loads a Key from its encoded form.
     *
     * By default, this function will call Encoding::trimTrailingWhitespace()
     * to remove trailing CR, LF, NUL, TAB, and SPACE characters, which are
     * commonly appended to files when working with text editors.
     *
     * @param string $savedKeyString
     * @param bool   $doNotTrim      (default: false)
     *
     * @throws BadFormatException
     * @throws EnvironmentIsBrokenException
     *
     * @return Key
     */
    public function loadFromAsciiSafeString($savedKeyString, $doNotTrim = false);
}
