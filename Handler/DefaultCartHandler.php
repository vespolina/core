<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Handler;

use Vespolina\CartBundle\Handler\AbstractCartHandler;
use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Model\CartItemInterface;

/**
 * DefaultHandler for the cart
 */
class DefaultCartHandler extends  AbstractCartHandler
{
    protected $fulfillmentPricingEnabled;
    protected $taxPricingEnabled;

    public function __construct()
    {
        $this->fulfillmentPricingEnabled = true;
        $this->taxPricingEnabled = true;
    }

    public function determineCartItemPrices(CartItemInterface $cartItem, $pricingContext)
    {

        $pricing = $cartItem->getCartableItem()->getPricing();

        $unitPrice = $pricing['unitPriceTotal'];
        $upCharge = 0;

        //Add additional upcharges for a chosen product option
        $upCharge = $this->determineCartItemUpCharge($cartItem, $pricingContext);

        //Calculate fulfillment costs (eg. shipping, packaging cost)
        if ($this->fulfillmentPricingEnabled) {

            //$this->determineCartItemFulfillmentPrices($cartItem, $pricingContext);
        }

        //Calculate item level totals
        $totalPrice = ( $cartItem->getQuantity() * $unitPrice ) + $upCharge;

        $pricingSet = $cartItem->getPricingSet();

        $pricingSet->set('upcharge', $upCharge);
        $pricingSet->set('total', $totalPrice);

        //Determine item level taxes
        if (null != $this->taxationManager) {

            $pricingSet->set('total', $totalPrice);
            $this->determineCartItemTaxes(
                    $cartItem,
                    array('total' => $totalPrice),
                    $pricingSet,
                    $pricingContext);

            $totalWithTax = $totalPrice + $pricingContext->get('totalTax');
            $pricingSet->set('totalWithTax', $totalWithTax);
        }

        // set the total price in the cart item
        $cartItem->setTotalPrice($totalPrice);
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

    protected function determineCartItemTaxes(CartItemInterface $cartItem, $prices, $cartItemPricingSet, $pricingContext)
    {

        $rate = 0;
        $taxes = array();

        //Here we currently assume that all cart items use the default tax zone
        $taxZone = $pricingContext->get('taxZone');

        if (null != $taxZone) {

            $rate = $taxZone->getDefaultRate();
        }

        foreach($prices as $name => $value) {

            $taxValue = $$rate * $value / 100;
            $taxes[$name] = $taxValue;

            $cartItemPricingSet->set($name . 'Tax', $taxValue);
            $pricingContext->set($name . 'Tax', $taxValue);
        }

        return $taxes;
    }

    protected function determineCartFulfillmentPrices(CartInterface $cart, $pricingContext)
    {
        //Additional fulfillment to be applied not related to cart item taxes
        // eg. fixed fulfillment fee
    }

    protected function sumItemPrices(CartItemInterface $cartItem, $pricingContext)
    {
        $pricingContext['total'] += $cartItem->getPrice('total');
    }
}
