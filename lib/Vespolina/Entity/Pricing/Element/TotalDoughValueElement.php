<?php

namespace Vespolina\Entity\Pricing\Element;

use Vespolina\Entity\Pricing\PricingElement;
use Vespolina\Entity\Pricing\PricingElementValueInterface;

class TotalDoughValueElement extends PricingElement implements PricingElementValueInterface
{
    protected $position = 100000;

    public function add($augend, $addend)
    {
        return $augend->plus($addend);
    }

    public function subtract($minuend, $subtrahend)
    {
        return $minuend->reduce($subtrahend);
    }

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
