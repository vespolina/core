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
 * @author Daniel Kucharski <develop@zestic.com>
 */
class CartPricingProvider implements CartPricingProviderInterface
{

    public function createPricingContextContainer()
    {
        $pricingContextContainer = new ArrayCollection();

        return $pricingContextContainer;
    }

    public function determineCartPrices(CartInterface $cart, $pricingContextContainer = null, $determineItemPrices = true) {

        if (!$pricingContextContainer) {
            $pricingContextContainer = $this->createPricingContextContainer();

            $pricingContextContainer['total'] = 0;
            $pricingContextContainer['subTotal'] = 0;
        }

        foreach ($cart->getItems() as $cartItem) {

            if ($determineItemPrices) {

                $this->determineCartItemPrices($cart, $cartItem, $pricingContextContainer);
            }

            $this->sumItemPrices($cartItem, $pricingContextContainer);
        }

        $cart->setSubTotal($pricingContextContainer['subTotal']);
        $cart->setTotal($pricingContextContainer['total']);


    }

    public function determineCartItemPrices(CartInterface $cart, CartItemInterface $cartItem, $pricingContextContainer = null) {

        if (!$pricingContextContainer) {
            $pricingContextContainer = $this->createPricingContextContainer();
        }

        $totalPrice = $cartItem->getQuantity() * $cartItem->getUnitPrice();
        $cartItem->setTotalPrice($totalPrice);
    }

    public function sumItemPrices(CartItemInterface $cartItem, $pricingContextContainer) {

        $pricingContextContainer['subTotal'] += $cartItem->getTotalPrice();
        $pricingContextContainer['total'] += $cartItem->getTotalPrice();


    }
}
