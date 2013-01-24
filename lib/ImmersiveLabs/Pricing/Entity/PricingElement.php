<?php

namespace ImmersiveLabs\Pricing\Entity;

use Vespolina\Entity\Pricing\PricingElementInterface;
use Vespolina\Exception\FunctionNotSupportedException;

class PricingElement implements PricingElementInterface
{
    protected $id;
    protected $attributes;
    protected $position;
    protected $type;

    public function __construct()
    {
        $this->attributes['netValue']  = '';
    }

    public function setNetValue($netValue)
    {
        $this->attributes['netValue']  = $netValue;

        return $this;
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

    /**
     * Set the order of this element being processed. If the order is not set, it is saved until the end of the
     * processing to be executed. The higher the number, the later it is executed.
     *
     * @param integer $position
     * @return \ImmersiveLabs\Pricing\Entity\PricingElement
     */
    function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Return the order of this element's execution
     *
     * @return integer
     */
    function getPosition()
    {
        return $this->position;
    }

    public function getId()
    {
        return $this->id;
    }
}
