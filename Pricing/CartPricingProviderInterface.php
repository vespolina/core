<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Pricing;

use Vespolina\CartBundle\Handler\CartHandlerInterface;
use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Model\CartItemInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
interface CartPricingProviderInterface
{
    /**
     * Add a cart handler for a product to the pricing provider
     *
     * @param \Vespolina\CartBundle\Handler\CartHandlerInterface $handler
     */
    function addCartHandler(CartHandlerInterface $handler);

    /**
     * Create a pricing context which holds 'global variables' used while computing prices
     *
     * @abstract
     *
     * @return
     */
    function createPricingContext();

    /**
     * Determine cart and (optionally) item level prices
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