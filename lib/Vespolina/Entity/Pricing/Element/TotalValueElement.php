<?php

namespace Vespolina\Entity\Pricing\Element;

use Vespolina\Entity\Pricing\PricingElement;
use Vespolina\Entity\Pricing\PricingElementValueInterface;

class TotalValueElement extends PricingElement implements PricingElementValueInterface
{
    protected $position = 100000;

    public function add($augend, $addend)
    {
        throw new FunctionNotSupportedException('add() has not been implemented in ' . get_class($this));
    }

    public function subtract($minuend, $subtrahend)
    {
        throw new FunctionNotSupportedException('subtract() has not been implemented in ' . get_class($this));
    }

    protected function doProcess($context, $processed)
    {
        $totalValue = $processed['netValue'];
        // todo: calculate other preset groups 'discounts', 'surcharge', 'taxes'

        $processed['totalValue'] = $totalValue;

        return $processed;
    }
}
