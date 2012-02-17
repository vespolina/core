<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Pricing;


interface CartPricingProviderInterface
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
     * @param Vespolina\CartBundle\Model\CartableItemInterface $cartableItem
     * @return CartItemInterface
     */
    function createItem(CartableItemInterface $cartableItem = null);
}