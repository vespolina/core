<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Model;

use Vespolina\CartBundle\Model\CartInterface;

interface CartManagerInterface
{
    /**
     * Create a cart instance
     *
     * @abstract
     * @param string $name Name of the cart
     * @return void
     */
    function createCart($name = 'default');

    /**
     * Create a cart item
     *
     * @abstract
     * @param null $product
     * @return CartItemInterface
     */
    function createItem($product = null);

    /**
     * Create a cart option
     *
     * @abstract
     * @param $type
     * @param $value
     */
    function createOption($type, $value);

    /**
     * Find an open cart for the given cart owner
     *
     * @abstract
     * @param $owner
     * @param string $cartState
     */
    function findOpenCartByOwner($owner);


    /**
     * Save or update the supplied cart
     * 
     * @abstract
     * @param \Vespolina\CartBundle\Model\CartInterface $cart
     * @param $andFlush
     * @return void
     */
    function updateCart(CartInterface $cart, $andFlush = true);

}