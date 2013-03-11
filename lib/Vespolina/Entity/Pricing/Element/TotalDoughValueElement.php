<?php

namespace Vespolina\Entity\Pricing\Element;

use Vespolina\Entity\Pricing\PricingElement;

class TotalDoughValueElement extends PricingElement
{
    protected $position = 100000;

    protected function doProcess($context, $processed)
    {
        $totalValue = $processed['netValue']->reduce($processed['discounts']);
        if (isset($processed['surcharge'])) {
            $totalValue = $totalValue->plus($processed['surcharge']);
        }
        if (isset($processed['taxes'])) {
            $totalValue = $totalValue->plus($processed['taxes']);
        }
        $processed['totalValue'] = $totalValue;

        return $processed;
    }
}
