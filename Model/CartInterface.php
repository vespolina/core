<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\ProductBundle\Model\Option\OptionInterface;

/**
 * CartInterface is a generic interface for shopping cart
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface CartInterface
{
    /**
     * Add item to cart
     *
     * @abstract
     * @param CartItemInterface $cartItem
     * @return void
     */
    function addItem(CartItemInterface $cartItem);

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
     */
    function getItem($index);

    /**
     * Retrieve cart items
     *
     * @abstract
     * @return array of CartItemInterface compatible instances
     */
    function getItems();

    /**
     * Get name of the cart (useful in multi-cart environments)
     */
    function getName();

    /**
     * Get cart owner
     *
     * @abstract
     * @return void
     */
    function getOwner();

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