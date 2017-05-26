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
 * CreateKeyDummyTrait.
 */
trait CreateKeyDummyTrait
{
    private $mockedKey = false;

    /**
     * Create dummy for Key.
     *
     * @return Key
     */
    private function createKeyDummy()
    {
        return Key::loadFromAsciiSafeString(
            'def00000a40a5fd84715a69beb6c0ee33aa2d69327e6741d3a5808112f1990715d78'
            . '70879c4b9a421fe42e3d7e2811cc4da63c15c988d240cbede275298811fbba827726'
        );
    }
}
