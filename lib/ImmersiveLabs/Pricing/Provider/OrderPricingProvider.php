<?php

namespace ImmersiveLabs\Pricing\Provider;
use Vespolina\Entity\Order\OrderInterface;
use ImmersiveLabs\Pricing\Entity\PricingContext;
use Vespolina\Entity\Pricing\PricingContextInterface;
use Vespolina\Entity\Order\ItemInterface;

class OrderPricingProvider
{
    // method that updates the pricing for the given order
    public function updatePricing(OrderInterface $order, PricingContextInterface $pricingContext = null)
    {
        // not implemented
        if ($pricingContext === null) {
            $pricingContext = $this->createPricingContext();
        }

        $itemsTotalNet = 0;
        // updating prices for each item
        foreach ($order->getItems() as $item) {
            /** @var ItemInterface $item */
            $pricing = $item->getPricing();
            $itemsTotalNet += $pricing['netValue'];
        }

        $previousTotal = $pricingContext->get('totalNet');
        $pricingContext->set('totalNet', $previousTotal + $itemsTotalNet);

        // if pricing context has taxation enabled we calculate the taxes with the percentage set
        // example taxRates : 0.10 for 10%, 0.25 for 25%
        if ($pricingContext->get('taxRate')) {
            $pricingContext->set('totalTax', $pricingContext->get('totalNet') * $pricingContext->get('taxRate'));
        }

        return $pricingContext;
    }

    /**
     * @return \ImmersiveLabs\Pricing\Entity\PricingContext
     */
    public function createPricingContext()
    {
        $pricingContext = new PricingContext();
        $pricingContext->set('totalNet', 0);
        $pricingContext->set('totalTax', 0);
        $pricingContext->set('totalGross', 0);

        return $pricingContext;
    }


}
