<?php

namespace ImmersiveLabs\Pricing\Entity\Element;

<<<<<<< HEAD:lib/ImmersiveLabs/Pricing/Entity/Element/TotalValueElement.php
use ImmersiveLabs\Pricing\Entity\PricingElement;
=======
use Vespolina\Entity\Pricing\PricingElement;
use Vespolina\Entity\Pricing\PricingElementValueInterface;
>>>>>>> updates to pricing set code:lib/Vespolina/Entity/Pricing/Element/TotalValueElement.php

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
