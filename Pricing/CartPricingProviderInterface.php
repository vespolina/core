<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Pricing;

use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Model\CartItemInterface;

interface CartPricingProviderInterface
{
    /**
     * Create a pricing context container which holds 'global variables' used for computing all prices
     *
     * @abstract
     *
     */
    function createPricingContext();

    /**
     * Determine cart and (optionally) item levle prices
     *
     * @abstract
     * @param \Vespolina\CartBundle\Model\CartInterface $cart
     * @param $pricingContext
     * @param $determineItemPrices
     */
    function determineCartPrices(CartInterface $cart, $pricingContext = null, $determineItemPrices = true);

    /**
     * @abstract
     * @param \Vespolina\CartBundle\Model\CartItemInterface $cartItem
     * @param $pricingContext
     */
    function determineCartItemPrices(CartItemInterface $cartItem, $pricingContext = null);

}