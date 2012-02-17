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
     * Create a pricing context container which holds 'global variables' used while computing all prices
     *
     * @abstract
     *
     */
    function createPricingContextContainer();

    /**
     * Determine cart and (optionally) item levle prices
     *
     * @abstract
     * @param \Vespolina\CartBundle\Model\CartInterface $cart
     * @param $pricingContextContainer
     * @param $determineItemPrices
     */
    function determineCartPrices(CartInterface $cart, $pricingContextContainer = null, $determineItemPrices = true);

    /**
     * @abstract
     * @param \Vespolina\CartBundle\Model\CartInterface $cart
     * @param \Vespolina\CartBundle\Model\CartItemInterface $cartItem
     * @param $pricingContextContainer
     */
    function determineCartItemPrices(CartInterface $cart, CartItemInterface $cartItem, $pricingContextContainer = null);

}