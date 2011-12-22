<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 
 
namespace Vespolina\CartBundle\Model;

use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\MerchandiseBundle\Model\MerchandiseInterface;
use Vespolina\ProductBundle\Model\Option\OptionGroupInterface;
use Vespolina\ProductBundle\Model\Option\OptionInterface;

/**
 * CartItemInterface is a generic interface for shopping cart item
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface CartItemInterface
{

    function addOption($type, $value);

    /**
     * Get the cart to which this item belongs
     *
     * @abstract
     *
     */
    function getCart();

    /**
     * @abstract
     *
     * @return ProductInterface product
     */
    function getProduct();

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
     * Set the referenced product
     *
     * @abstract
     * @param $product
     * @return void
     */
    function setProduct($product);


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
}