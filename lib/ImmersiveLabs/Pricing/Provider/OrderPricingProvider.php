<?php

namespace ImmersiveLabs\Pricing\Provider;

use Vespolina\Entity\Order\OrderInterface;
use ImmersiveLabs\Pricing\Entity\PricingSet;
use ImmersiveLabs\Pricing\Entity\PricingContext;
use Vespolina\Entity\Pricing\PricingContextInterface;
use Vespolina\Entity\Order\ItemInterface;
use Vespolina\Order\Pricing\OrderPricingProviderInterface;
use Vespolina\Order\Handler\OrderHandlerInterface;
use ImmersiveLabs\BillingBundle\Provider\TaxProvider;

class OrderPricingProvider implements OrderPricingProviderInterface
{
    /** @var TaxProvider */
    protected $taxProvider;

    public function __construct(TaxProvider $taxProvider)
    {
        $this->taxProvider = $taxProvider;
    }

    // method that updates the pricing for the given order
    public function determineOrderPrices(OrderInterface $order, PricingContextInterface $pricingContext = null)
    {
        // not implemented
        if ($pricingContext === null) {
            $pricingContext = $this->createPricingContext();
        }

        if (!$orderPricingSet = $order->getPricing()) {
            $orderPricingSet = new PricingSet();
            $order->setPricing($orderPricingSet);
        }

        foreach ($order->getItems() as $item) {
            $this->determineOrderItemPrices($item, $pricingContext);
        }

        // summing it up
        $itemsTotalNet = 0;

        // updating prices for each item
        foreach ($order->getItems() as $item) {
            // this is the total value since we want to capture any calculations that happen on a specific item
            $itemsTotalNet += $item->getPricing()->get('netValue');
        }

        $orderPricingSet->set('totalNet', $itemsTotalNet);


        // if pricing context has taxation enabled we calculate the taxes with the percentage set
        // example taxRates : 0.10 for 10%, 0.25 for 25%
        if ($partner = $pricingContext->get('partner')) {
            /** @var $partner \Vespolina\Entity\Partner\Partner */
            if (count($partner->getAddresses())) {
                /** @var $address \Vespolina\Entity\Partner\AddressInterface */
                $address = $partner->getAddresses()->get(0);
                $rate = $this->taxProvider->getTaxForAddress($address);
                $totalTax = $itemsTotalNet * $rate;
                $orderPricingSet->set('taxRate', $rate);
                $orderPricingSet->set('taxes', $totalTax);
                $orderPricingSet->set('totalValue', $itemsTotalNet + $totalTax);
            }
        }

        $orderPricingSet->setProcessingState(PricingSet::PROCESSING_FINISHED);
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
        $productPricing = $item->getProduct()->getPricing();
        $itemPricing = $productPricing->process($pricingContext);
        $item->setPricing($itemPricing);
    }
}
