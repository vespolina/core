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

class TotalValueElement extends PricingElement implements PricingElementValueInterface
{
    protected $position = 100000;

    public function add($augend, $addend)
    {
        return $augend + $addend;
    }

    public function subtract($minuend, $subtrahend)
    {
        return $minuend - $subtrahend;
    }

    protected function doProcess($context, $processed)
    {
        $totalValue = $processed['values']['netValue'];
        if (isset($processed['values']['discounts'])) {
            $totalValue = $this->subtract($totalValue, $processed['values']['discounts']);
        }
        if (isset($processed['values']['surcharge'])) {
            $totalValue = $this->add($totalValue, $processed['values']['surcharge']);
        }
        if (isset($processed['values']['taxes'])) {
            $totalValue = $this->add($totalValue, $processed['values']['taxes']);
        }
        $processed['values']['totalValue'] = $totalValue;

        return $processed;
    }
}
