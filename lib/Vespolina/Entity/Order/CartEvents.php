<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Order;

final class CartEvents
{
    /**
     * The cart initialization cart is is triggered after a new cart is created and initialized
     */
    const INIT_CART = 'vespolina_cart.cart_init';

    /**
     * INIT_ITEM is triggered when an product is added to the cart
     */
    const INIT_ITEM = 'vespolina_cart.item_init';

    /**
     * After a pricing context has been created, following event is called to initialize the pricing context.
     * The pricing context is typically used to inject context dependent pricing parameters
     *
     * For instance one could inject an explicit discount or tax percentage, possible
     * overriding default parameters.
     */
    const INIT_PRICING_CONTEXT = 'vespolina_cart.init_pricing_context';

    /**
     * The cart finished event is triggered  when all basic operations on a cart have been completed
     * For instance one first adds three items, adjust quantity and then triggers the cart finished event
     */
    const FINISHED = 'vespolina_cart.cart_finished';

    /**
     * REMOVE_ITEM is triggered a product has been completely removed from a cart
     */
    const REMOVE_ITEM = 'vespolina_cart.item_remove';

    /**
     * UPDATE_CART is triggered to alert that an update to the cart is needed
     */
    const UPDATE_CART = 'vespolina_cart.cart_update';

    /**
     * UPDATE_CART_PRICE is triggered to alert that the prices in the cart are needed
     */
    const UPDATE_CART_PRICE = 'vespolina_cart.cart_update_price';

    /**
     * UPDATE_CART_STATE is triggered when the state of the cart has changed
     */
    const UPDATE_CART_STATE = 'vespolina_cart.cart_update_state';

    /**
     * UPDATE_ITEM is triggered when the a quantity or options in a item as changed
     */
    const UPDATE_ITEM = 'vespolina_cart.item_update';

    /**
     * UPDATE_ITEM_STATE is triggered when the state of an item in the cart has changed
     */
    const UPDATE_ITEM_STATE = 'vespolina_cart.item_update_state';
}