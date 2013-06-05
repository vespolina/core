<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Order;

use Vespolina\Entity\Channel\ChannelInterface;
use Vespolina\Entity\Order\ItemInterface;

/**
 * OrderInterface is a generic interface for a shopping cart or sales order
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
interface OrderInterface
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
     * A test to see if the cart doesn't have any items in it
     *
     * @return boolean
     */
    function isEmpty();

    /**
     * Return the channel which resulted into this order
     *
     * @return ChannelInterface
     */
    function getChannel();

    /**
     * Set the channel which resulted into this order
     *
     * @param ChannelInterface $channel
     * @return mixed
     */
    function setChannel(ChannelInterface $channel);

    /**
     * Add an item to the order
     *
     * @param ItemInterface $item
     */
    function addItem(ItemInterface $item);

    /**
     * Remove all items
     */
    function clearItems();

    /**
     * Retrieve all items in the order
     *
     * @return \Vespolina\Entity\Order\ItemInterface[]
     */
    function getItems();

    /**
     * Set the items for this order
     *
     * @param Array of Vespolina\Entity\ItemInterface
     */
    function setItems($items);

    /**
     * Merge an array of items to the items already in the order
     *
     * @param \Vespolina\Entity\Order\ItemInterface[] $items
     */
    function mergeItems(array $items);

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
     * @return mixed
     */
    function getOwner();

    function setPricing($pricingSet);

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
     *
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