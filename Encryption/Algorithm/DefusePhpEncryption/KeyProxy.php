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

use Defuse\Crypto\Key;

/**
 * KeyProxy.
 */
class KeyProxy implements KeyProxyInterface
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
    public function __construct($completeClassName = Key::class)
    {
        $this->fullyQualifiedClassName = $completeClassName;
    }

    /**
     * @inheritDoc
     */
    public function loadFromAsciiSafeString($savedKeyString, $doNotTrim = false)
    {
        return forward_static_call_array(
            [$this->fullyQualifiedClassName, 'loadFromAsciiSafeString'],
            [$savedKeyString, $doNotTrim]
        );
    }
}
