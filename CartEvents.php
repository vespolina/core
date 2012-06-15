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
     * The cart finished event is triggered  when all basic operations on a cart have been completed
     * For instance one first adds three items, adjust quantity and then triggers the cart finished event
     *
     * @var string
     */
    const CART_FINISHED = 'vespolina_cart.cart_finished';
}