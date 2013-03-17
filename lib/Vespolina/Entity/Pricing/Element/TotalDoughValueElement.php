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
        $totalValue = $processed['values']['netValue']->reduce($processed['values']['discounts']);
        if (isset($processed['values']['surcharge'])) {
            $totalValue = $totalValue->plus($processed['values']['surcharge']);
        }
        if (isset($processed['values']['taxes'])) {
            $totalValue = $totalValue->plus($processed['values']['taxes']);
        }
        $processed['values']['totalValue'] = $totalValue;

        return $processed;
    }
}
