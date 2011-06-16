<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Model;

use \DateTime;
use Vespolina\CartBundle\Model\CartInterface;

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
     * Get the date when this cart was created
     */
    function getCreatedAt();

    /**
     * Retrieve the uniquely identifying id for this cart
     */
    function getId();

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
     * Get the date when this cart was modified
     */
    function getUpdatedAt();
}