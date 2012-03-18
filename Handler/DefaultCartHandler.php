<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Handler;

use Vespolina\CartBundle\Handler\AbstractCartHandler;
use Vespolina\CartBundle\Model\CartItemInterface;

/**
 * DefaultHanlder for the cart
 */
class DefaultCartHandler extends  AbstractCartHandler
{
    protected $fulfillmentPricingEnabled;
    protected $taxPricingEnabled;

    public function __construct()
    {
        $this->fulfillmentPricingEnabled = true;
        $this->taxDeterminationEnabled = true;
    }

    public function determineCartItemPrices(CartItemInterface $cartItem, $pricingContext)
    {

        $pricing = $cartItem->getCartableItem()->getPricing();

        $unitPrice = $pricing['unitPrice'];
        $upCharge = 0;

        //Add additional upcharges for a chosen product option
        $upCharge = $this->determineCartItemUpCharge($cartItem, $pricingContext);

        //Determine item level taxes such as VAT or sales tax
        if ($this->taxPricingEnabled) {

            $this->determineCartItemTaxes($cartItem, $pricingContext);
        }

        //Calculate fulfillment costs (eg. shipping, packaging cost)
        if ($this->fulfillmentPricingEnabled) {

            //$this->determineCartItemFulfillmentPrices($cartItem, $pricingContext);
        }

        //Calculate item level totals
        $totalPrice = ( $cartItem->getQuantity() * $unitPrice ) + $upCharge;

        $pricingSet = $cartItem->getPricingSet();

        $pricingSet->set('upcharge', $upCharge);
        $pricingSet->set('total', $totalPrice);

    }

    public function getTypes()
    {
        return 'default';
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

    protected function sumItemPrices(CartItemInterface $cartItem, $pricingContext)
    {

        $pricingContext['subTotal'] += $cartItem->getPrice('subTotal'); //todo
        $pricingContext['total'] += $cartItem->getPrice('total');
    }
}
