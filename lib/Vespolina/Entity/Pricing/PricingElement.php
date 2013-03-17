<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\Entity\Pricing;

use Vespolina\Entity\Pricing\PricingElementInterface;
use Vespolina\Exception\FunctionNotSupportedException;

class PricingElement implements PricingElementInterface
{
    protected $position = 0;
    protected $pricingSet;
    protected $properties;
    protected $type;
    protected $values;

    public function __construct()
    {
        $this->values['netValue']  = '';
    }

    public function setNetValue($netValue)
    {
        $this->values['netValue']  = $netValue;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @inheritdoc
     */
    public function process($context, $processed)
    {
        return $this->doProcess($context, $processed);
    }

    protected function doProcess($context, $processed)
    {
        throw new FunctionNotSupportedException('process() has not been implemented in ' . get_class($this));
    }

    public function setPricingSet(PricingSetInterface $pricingSet)
    {
        $this->pricingSet = $pricingSet;

        return $this;
    }

    public function getPricingSet()
    {
        return $this->pricingSet;
    }
}
