<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

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
