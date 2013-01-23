<?php

namespace ImmersiveLabs\Pricing\Provider;

use Vespolina\Entity\Order\OrderInterface;
use ImmersiveLabs\Pricing\Entity\PricingSet;
use ImmersiveLabs\Pricing\Entity\PricingContext;
use Vespolina\Entity\Pricing\PricingContextInterface;
use Vespolina\Entity\Order\ItemInterface;
use Vespolina\Order\Pricing\OrderPricingProviderInterface;
use Vespolina\Order\Handler\OrderHandlerInterface;

class OrderPricingProvider implements OrderPricingProviderInterface
{
    // method that updates the pricing for the given order
    public function determineOrderPrices(OrderInterface $order, PricingContextInterface $pricingContext = null)
    {
        // not implemented
        if ($pricingContext === null) {
            $pricingContext = $this->createPricingContext();
        }

        foreach ($order->getItems() as $item) {
            $this->determineOrderItemPrices($item, $pricingContext);
        }

        // summing it up
        $itemsTotalNet = 0;

        // updating prices for each item
        foreach ($order->getItems() as $item) {
            /** @var ItemInterface $item */
            $pricing = $item->getPricing();
            $itemsTotalNet += $pricing['totalNet'];
        }

        if (!$pricingSet = $order->getPricing()) {
            $pricingSet = new PricingSet();
            $order->setPricing($pricingSet);
        }

        // if pricing context has taxation enabled we calculate the taxes with the percentage set
        // example taxRates : 0.10 for 10%, 0.25 for 25%
        if ($pricingContext->get('taxRate')) {
            $pricingSet->set('totalNet', $itemsTotalNet);
            $totalTax = $itemsTotalNet * $pricingContext->get('taxRate');
            $pricingSet->set('totalTax', $totalTax);
            $pricingSet->set('totalGross', $itemsTotalNet + $totalTax);
        }

        $pricingSet->setProcessingState(PricingSet::PROCESSING_FINISHED);
    }

    function createPricingSet()
    {
        $pricingSet = new PricingSet();

        return $pricingSet;
    }

    function addOrderHandler(OrderHandlerInterface $handler)
    {
    }

    function determineOrderItemPrices(ItemInterface $item, PricingContextInterface $pricingContext)
    {
        $productPricing = $item->getProduct()->getPricingSet();
        $itemPricing = $productPricing->process($pricingContext);

        $item->setPricing($itemPricing);
    }
}
