<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Pricing;

use Doctrine\Common\Collections\ArrayCollection;

use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Model\CartItemInterface;
use Vespolina\CartBundle\Pricing\CartPricingProviderInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
class SimpleCartPricingProvider implements CartPricingProviderInterface
{
    protected $fulfillmentPricingEnabled;
    protected $taxPricingEnabled;

    public function __construct()
    {
        $this->fulfillmentPricingEnabled = true;
        $this->taxDeterminationEnabled = true;
    }

    public function createPricingContext()
    {
        $context = new ArrayCollection();

        return $context;
    }

    public function determineCartPrices(CartInterface $cart, $pricingContext = null, $determineItemPrices = true)
    {

        if (!$pricingContext) {
            $pricingContext = $this->createPricingContext();

            $pricingContext['total'] = 0;
            $pricingContext['subTotal'] = 0;
        }

        foreach ($cart->getItems() as $cartItem) {

            if ($determineItemPrices) {

                $this->determineCartItemPrices($cartItem, $pricingContext);
            }

            //Sum item level totals into the pricing context
            $this->sumItemPrices($cartItem, $pricingContext);
        }

        //Determine header level fulfillment costs (eg. one shot tax)
        if ($this->fulfillmentPricingEnabled) {

            $this->determineCartFulfillmentPrices($cart, $pricingContext);
        }

          //Determine header level tax (eg. one shot tax)
        if ($this->taxPricingEnabled) {

            $this->determineCartTaxes($cart, $pricingContext);
        }

        $cart->setPrice('subTotal', $pricingContext['subTotal']);
        $cart->setPrice('total', $pricingContext['total']);

    }

    public function determineCartItemPrices(CartItemInterface $cartItem, $pricingContext = null) {

        if (!$pricingContext) {
            $pricingContext = $this->createPricingContext();
        }

        $unitPrice = $cartItem->getUnitPrice();
        $upCharge = 0;

        //Add additional upcharges for a chosen product option
        $upCharge = $this->determineCartItemUpCharge($cartItem, $pricingContext);

        //Determine item level taxes such as VAT or sales tax
        if ($this->taxPricingEnabled) {

            $this->determineCartItemTaxes($cartItem, $pricingContext);
        }

        //Calculate fulfillment costs (eg. shipping, packaging cost)
        if ($this->fulfillmentPricingEnabled) {

            $this->determineCartItemFulfillmentPrices($cartItem, $pricingContext);
        }

        //Calculate item level totals
        $totalPrice = ( $cartItem->getQuantity() * $cartItem->getUnitPrice() ) + $upCharge;

        $cartItem->setPrice('subTotal', $totalPrice);
        $cartItem->setPrice('total', $totalPrice);
    }

    protected function determineCartItemFulfillmentPrices(CartItemInterface $cartItem, $pricingContext)
    {

        /** Todo: Check what it costs to fulfill $cartItem->getCartable()
         *  - shipping
         *  - handling
         *  - packaging
         *  - additional fees
         */

    }

    protected function determineCartItemUpCharge(CartItemInterface $cartItem, $pricingContext)
    {
        $upCharge = 0;

        foreach($cartItem->getOptions() as $type => $value) {

            if ($productOption = $cartItem->getCartableItem()->getOptionSet(array($type => $value))) {
                $upCharge += $productOption->getUpcharge();
            }
        }

        return $upCharge;
    }

    protected function determineCartItemTaxes(CartItemInterface $cartItem, $pricingContext)
    {

    }

    protected function determineCartFulfillmentPrices(CartInterface $cart, $pricingContext)
    {
        //Additional fulfillment to be applied not related to cart item taxes
        // eg. fixed fulfillment fee
    }

    protected function determineCartTaxes(CartInterface $cart, $pricingContext)
    {
        //Additional taxes to be applied not related to cart item taxes
    }

    protected function sumItemPrices(CartItemInterface $cartItem, $pricingContext)
    {

        $pricingContext['subTotal'] += $cartItem->getPrice('subTotal'); //todo
        $pricingContext['total'] += $cartItem->getPrice('total');


    }
}
