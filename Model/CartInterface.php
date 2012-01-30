<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Model\CartItemInterface;
use Vespolina\ProductBundle\Model\Option\OptionInterface;

/**
 * CartInterface is a generic interface for shopping cart
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
interface CartInterface
{
    /**
     * Add item to cart
     *
     * @abstract
     * @param Vespolina\CartBundle\Model\CartItemInterface $cartItem
     * @return void
     */
    function addItem(CartItemInterface $cartItem);

    /**
     * Removes item to cart
     *
     * @abstract
     * @param Vespolina\CartBundle\Model\CartItemInterface $cartItem
     * @return void
     */
    function removeItem(CartItemInterface $cartItem);

    /**
     * Remove all items
     *
     * @abstract
     *
     */
    function clearItems();

    /**
     * Get the time when the cart was created
     *
     * @abstract
     *
     */
    function getCreatedAt();

    /**
     * Get the time when the cart will expire
     *
     * @abstract
     *
     */
    function getExpiresAt();

    /**
     * Get an id to the follow up entity for the cart.
     * Eg.  this could be the sales order id
     *
     * @abstract
     *
     */
    function getFollowUp();

    /**
     * Get cart item for a given index
     *
     * @return Vespolina\CartBundle\Model\CartItemInterface
     */
    function getItem($index);

    /**
     * Retrieve all items in the cart
     *
     * @return array of Vespolina\CartBundle\Model\CartItemInterface compatible instances
     */
    function getItems();

    /**
     * Return only the recurring items in the cart
     *
     * @return array of Vespolina\CartBundle\Model\CartItemInterface
     */
    function getRecurringItems();

    /**
     * Return the items from the cart that are not recurring
     *
     * @return array of Vespolina\CartBundle\Model\CartItemInterface
     */
    function getNonRecurringItems();

    /**
     * Get name of the cart (useful in multi-cart environments)
     *
     * @return string
     */
    function getName();

    /**
     * Get cart owner
     *
     * @return User or
     */
    function getOwner();

    /**
     * Return the current state of the cart
     *
     * @return
     */
    function getState();

    function getUpdatedAt();

    function setFollowUp($followUp);

    function setExpiresAt(\DateTime $expiresAt);

    function setState($state);

    /**
     * Return the sub total of the items in the cart
     *
     * @return price
     */
    function getSubTotal();

    /**
     * Return the grand total of the items in the cart
     *
     * @return price
     */
    function getTotal();
}