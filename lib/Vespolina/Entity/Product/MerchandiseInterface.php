<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

use Vespolina\Entity\Asset\AssetInterface;
use Vespolina\Entity\Channel\ChannelInterface;
use Vespolina\Entity\Product\BaseProductInterface;

interface MerchandiseInterface extends BaseProductInterface
{
    /**
     * Set the date this merchandise becomes active in the store.
     *
     * @param \DateTime $activateOn
     */
    function setActivateOn(\DateTime $activateOn);

    /**
     * Return the date when this merchandise becomes active in the store.
     *
     * @return \DateTime
     */
    function getActivateOn();

    /**
     * Set the merchandise to an active state in the store.
     *
     * When active is set to true, if the current time is not in the activate/deactivate time
     * range or the activateOn property is null, the activateOn will be set to the current time.
      *
     * When active is set to false, the deactivateOn will be set to the current time.
     *
     * @param boolean $active
     */
    function setActive($active);

    /**
     * Return if this merchandise is active. If the active property is not set, the activateOn/deactivateOn
     * time range is used to determine if its active.
     *
     * @return boolean
     */
    function getActive();

    /**
     * Set the date this merchandise becomes inactive in the store.
     *
     * @param \DateTime $deactivateOn
     */
    function setDeactivateOn(\DateTime $deactivateOn);

    /**
     * Return the date when this merchandise is no longer active in the store.
     *
     * @return \DateTime
     */
    function getDeactivateOn();

    /**
     * Return the product of this merchandise
     *
     * @return \Vespolina\Entity\Product\ProductInterface
     */
    function getProduct();

    /**
     * Set the channel to which this merchandise belongs to
     *
     * @param $store
     */
    function setChannel(ChannelInterface $channel);

    /**
     * Return the channel to which this merchandise belongs to
     *
     * @return
     */
    function getChannel();
}
