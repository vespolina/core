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
     * Set a payment instruction for this item
     *
     * @param $paymentInstruction
     */
    function setPaymentInstruction($paymentInstruction);

    /**
     * Return the payment instruction for this cart item, if there is one
     *
     * @return payment instruction or null
     */
    function getPaymentInstruction();

    /**
     * Get all options
     *
     * @abstract
     * @return void
     */
    function getOptions();

    /**
     * Get the pricing info for this cart item
     * @abstract
     * @return mixed
     */
    function getPricingSet();
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
     * @param $quantity
     * @return void
     */
    function setQuantity($quantity);
    /**
     * Set the name of the cart item
     *
     * @param string $name
     */
    function setName($name);

    function setPricingSet($pricingSet);

    /**
     * Return the name of the cart item
     *
     * @return string
     */
    function getName();

    /**
     * Set the total price for this item in the cart, if the pricing set is calculated it should be set from there
     *
     * @param string $totalPrice
     */

    function setTotalPrice($totalPrice);

    /**
     * Get the total price for this item
     *
     * @return string
     */
    function getTotalPrice();

    /**
     * Return if this cart item is recurring
     *
     * @return boolean
     */
    function isRecurring();
}