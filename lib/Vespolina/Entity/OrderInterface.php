<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity;

use Vespolina\Entity\ItemInterface;

/**
 * OrderInterface is a generic interface for shopping cart or sales order
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
interface OrderInterface
{
    /**
     * A test to see if the cart doesn't have any items in it
     *
     * @return boolean
     */
    function isEmpty();

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
     * @return array of Vespolina\Entity\ItemInterface compatible instances
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
     * @param array of Vespolina\Entity\ItemInterface $items
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
     * @param User $owner
     */
    function setOwner($owner);

    /**
     * Return the owner of the order
     *
     * @return User
     */
    function getOwner();

    /**
     * Set the current state of the order
     *
     * @return
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