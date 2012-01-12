<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Model;

use Vespolina\CartBundle\Model\CartInterface;

/**
 * CartItemInterface is a generic interface for shopping cart item
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
interface CartItemInterface
{
    /**
     * Add a option for the cartable item
     *
     * @param $type string or array with [$type] = $value
     * @param $value or null if array
     */
    function addOption($type, $value = null);

    /**
     * Get the cart to which this item belongs
     *
     * @return Vespolina\CartBundle\Model\CartInterface
     */
    function getCart();

    /**
     * Return the cartable item in the cart
     *
     * @abstract
     *
     * @return Vespolina\CartBundle\Model\CartableItemInterface
     */
    function getCartableItem();

    /**
     * Get all options
     *
     * @abstract
     * @return void
     */
    function getOptions();

    /**
     * Get the cart state for this item
     *
     * @abstract
     * @return void
     */
    function getState();

    /**
     * Get the quantity
     *
     * @abstract
     * @return void
     */
    function getQuantity();

    /**
     * Set the cart to which this item belongs to
     *
     * @abstract
     * @param CartInterface $cart
     */
    function setCart(CartInterface $cart);

    /**
     * Set the state of this item
     *
     * @abstract
     * @param $state
     * @return void
     */
    function setState($state);

    /**
     * Set the quantity
     *
     * @abstract
     * @param $quantity
     * @return void
     */
    function setQuantity($quantity);

    /**
     * Set the price of the cart item
     *
     * @param $price
     */
    function setPrice($price);

    /**
     * Return the price of the cart item
     *
     * @return price
     */
    function getPrice();

    /**
     * Set the name of the cart item
     *
     * @param string $name
     */
    function setName($name);

    /**
     * Return the name of the cart item
     *
     * @return string
     */
    function getName();

    /**
     * Return if this cart item is a subscription
     *
     * @return boolean
     */
    function isSubscription();
}