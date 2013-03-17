<?php

namespace Vespolina\Entity\Pricing\Element;

use Vespolina\Entity\Pricing\PricingElement;
use Vespolina\Entity\Pricing\PricingElementValueInterface;

class TotalDoughValueElement extends TotalValueElement
{
    protected $position = 100000;

    public function add($augend, $addend)
    {
        $sum = $augend->plus($addend);

        return $sum->reduce();
    }

    public function subtract($minuend, $subtrahend)
    {
        $sum = $minuend->subtract($subtrahend);

        return $sum->reduce();
    }
}
