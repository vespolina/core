<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle;

final class CartEvents
{

    /**
     * After a pricing context has been created, following event is called to initialize the pricing context.
     * The pricing context is typically used to inject price related parameters required to perform
     * actual calculations.  For instance one could inject an explicit discount or tax percentage, possible
     * overriding default parameters.
     */
    const CART_INIT_PRICING_CONTEXT = 'vespolina_cart.init_pricing_context';

    /**
     * The cart finished event is triggered  when all basic operations on a cart have been completed
     * For instance one first adds three items, adjust quantity and then triggers the cart finished event
     *
     * @var string
     */
    const CART_FINISHED = 'vespolina_cart.cart_finished';

}