<?php

namespace ImmersiveLabs\Pricing\Entity\Element;

use ImmersiveLabs\Pricing\Entity\PricingElement;

class TotalValueElement extends PricingElement
{
    protected $position = 100000;

    protected function doProcess($context, $processed)
    {
        $totalValue = $processed['netValue'];
        // todo: calculate other preset groups 'discounts', 'surcharge', 'taxes'

        $processed['totalValue'] = $totalValue;

        return $processed;
    }
}
