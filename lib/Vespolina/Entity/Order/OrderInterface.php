<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Order;

use Vespolina\Entity\Channel\ChannelInterface;
use Vespolina\Entity\ItemableInterface;

/**
 * OrderInterface is a generic interface for a shopping cart and subsequent order
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
interface OrderInterface extends ItemableInterface
{
    /**
     * Add an attribute to the collection
     *
     * @param $name
     * @param $value
     * @return mixed
     */
    function addAttribute($name, $value);

    /**
     * Add a collection of Attribute
     *
     * @param array $attributes
     */
    function addAttributes(array $attributes);

    /**
     * Remove all attributes from the collection
     */
    function clearAttributes();

    /**
     * Return a specific attribute from the collection
     *
     * @param $name
     */
    function getAttribute($name);

    /**
     * Return a collection of Attribute
     *
     * @return array of attributes
     */
    function getAttributes();

    /**
     * Remove an attribute from the collection
     *
     * @param string $name
     */
    function removeAttribute($name);

    /**
     * Set a collection of Attribute
     *
     * @param array $attributes
     */
    function setAttributes(array $attributes);

    /**
     * A test to see if the order doesn't have any items in it
     *
     * @return boolean
     */
    function isEmpty();

    /**
     * Return the channel which was used to create this order
     *
     * @return ChannelInterface
     */
    function getChannel();

    /**
     * Set the channel which resulted into this order
     *
     * @param \Vespolina\Entity\Channel\ChannelInterface $channel
     * @return self
     */
    function setChannel(ChannelInterface $channel);

    /**
     * Get name of the order (useful in multi-order environments)
     *
     * @param string $name
     */
    function setName($name);

    /**
     * Return the name of the order (useful in multi-order environments)
     *
     * @return string
     */
    function getName();

    /**
     * Set the owner of the owner
     *
     * @param mixed $owner
     */
    function setOwner($owner);

    /**
     * Return the owner of the order
     *
     * @return \Vespolina\Entity\Partner\PartnerInterface
     */
    function getOwner();

    /**
     * This typically include values such a total order value.
     * @param $pricingSet
     */
    function setPricing($pricingSet);

    /**
     * Retrieve the pricing set associated to the order
     * This typically include values such a total order value.
     *
     * @return mixed
     */
    function getPricing();

    /**
     * Set the current state of the order
     *
     * @param $state
     * @return \Vespolina\Entity\Order\OrderInterface
     */
    function setState($state);

    /**
     * Return the current state of the order
     *
     * @return
     */
    function getState();

    /**
     * Set the total price for the order
     * Proxy method which sets the total price in the pricing set

     * @param $totalPrice
     */
    function setTotalPrice($totalPrice);

    /**
     * Return the total price for the order
     *
     * @return string
     */
    function getTotalPrice();
}