<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Channel;

/**
 * Interface defining a sales channel
 * (eg. web channel, point of sales channel, ..)
 */
interface ChannelInterface
{

    function getName();
    function setName($name);
}
