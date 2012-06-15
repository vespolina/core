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
class SimpleCartPricingProvider extends AbstractCartPricingProvider
{
    protected $fulfillmentPricingEnabled;

    public function __construct()
    {
        $this->fulfillmentPricingEnabled = true;
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
        }

        //If a taxation manager exists let's prepare the pricing context for taxation purposes
        if (null != $this->taxationManager) {

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

        // Determine header level tax (eg. one shot tax)
        if (null != $this->taxationManager) {
            $this->determineCartTaxes($cart, $pricingContext);
        }

        $cartPricingSet = $cart->getPricingSet();
        $cartPricingSet->set('total', $pricingContext['total']);
        $cart->setTotalPrice($pricingContext['total']);
    }

    // the code that was here is at https://gist.github.com/2035304 in case it is needed for a handler
    public function determineCartItemPrices(CartItemInterface $cartItem, $pricingContext = null)
    {
        if (!$pricingContext) {
            $pricingContext = $this->createPricingContext();
        }

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
        $pricingContext['total'] += $cartItem->getPricingSet()->get('total');
    }
}
