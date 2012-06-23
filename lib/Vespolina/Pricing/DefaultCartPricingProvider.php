<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Pricing;

use Doctrine\Common\Collections\ArrayCollection;

use Vespolina\CartBundle\Handler\CartHandlerInterface;
use Vespolina\CartBundle\Model\CartableItemInterface;
use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Model\CartItemInterface;
use Vespolina\CartBundle\Pricing\AbstractCartPricingProvider;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
class DefaultCartPricingProvider extends AbstractCartPricingProvider
{
    // TODO: this will probably be removed from core

    protected $fulfillmentPricingEnabled;

    public function __construct()
    {
        $this->fulfillmentPricingEnabled = true;
    }

    public function createPricingContext()
    {
        return new ArrayCollection();
    }

    public function determineCartPrices(CartInterface $cart, $pricingContext = null, $determineItemPrices = true)
    {

        if (null == $pricingContext) {
            $pricingContext = $this->createPricingContext();
            $pricingContext['totalNett'] = 0;
            $pricingContext['totalGross'] = 0;

        }
        //Check if the cart has taxation enabled
        $taxationEnabled = $cart->getAttribute('taxation_enabled');

        if ($taxationEnabled) {

            $pricingContext['totalTax'] = 0;
            $this->preparePricingContextForTaxation($pricingContext);
        }

        foreach ($cart->getItems() as $cartItem) {

            if ($determineItemPrices) {
                $this->determineCartItemPrices($cartItem, $pricingContext);
            }

            // Sum item level totals into the pricing context
            $this->sumItemPrices($cartItem, $pricingContext);
        }

        // Determine header level fulfillment costs (eg. one shot tax)
        if ($this->fulfillmentPricingEnabled) {
            $this->determineCartFulfillmentPrices($cart, $pricingContext);
        }

        $cartPricingSet = $cart->getPricingSet();
        $cartPricingSet->set('totalNett', $pricingContext['totalNett']);

        // Determine header level tax (eg. one shot tax)
        if ($taxationEnabled) {

            $this->determineCartTaxes($cart, $pricingContext);
            $totalGross =  $pricingContext['totalNett'] +  $pricingContext['totalTax'];
            $cartPricingSet->set('totalTax', $pricingContext['totalTax']);

        } else {
            $totalGross = $pricingContext['totalNett'];
        }
        $cartPricingSet->set('totalGross', $totalGross);
        $cart->setTotalPrice($pricingContext['totalNett']); //Todo: remove

    }

    public function determineCartItemPrices(CartItemInterface $cartItem, $pricingContext)
    {

        $handler = $this->getCartHandler($cartItem);
        $handler->determineCartItemPrices($cartItem, $pricingContext);
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

    protected function preparePricingContextForTaxation($pricingContext)
    {
        //Find out if the tax zone was supplied
        $taxZone = $pricingContext->get('taxZone');

        if (null == $taxZone) {

            //Check if a fulfillment address was explicitly set
            $address = $pricingContext->get('fulfillmentAddress');

            if (null == $address) {

                //We we don't have a fulfillment address, we use now the customer's info
                $customer = $pricingContext->get('customer');

                if (null != $customer) {
                    $address = $customer->getAddresses()->first();  //Todo: should use delivery address
                }
            }

            if (null != $address) {

                //So we have an address, lookup the tax zone
                $taxZone =  $this->taxationManager->findTaxZoneByAddress($address);
                $pricingContext->set('taxZone', $taxZone);
            }
        }
    }

    protected function sumItemPrices(CartItemInterface $cartItem, $pricingContext)
    {
        $cartItemPricingSet = $cartItem->getPricingSet();

        $pricingContext['totalNett'] += $cartItemPricingSet->get('totalNett');
        $pricingContext['totalGross'] += $cartItemPricingSet->get('totalGross');

        if (null != $this->taxationManager) {

            $pricingContext['totalTax'] += $cartItemPricingSet->get('totalTax');
        }
    }
}
