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
    protected $netValue;
    protected $order;
    protected $processed;
    protected $value;

    public function setNetValue($netValue)
    {
        $this->netValue = $netValue;

        return $this;
    }

    public function getNetValue()
    {
        return $this->netValue;
    }

    /**
     * @inheritdoc
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getOrder()
    {
        return $this->order;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }
    /**
     * @inheritdoc
     */
    public function process()
    {
        if (!$this->processed) {
            return $this->doProcess();
        }

        return true;
    }

    protected function doProcess()
    {
        throw new FunctionNotSupportedException('process() has not been implemented in ' . get_class($this));
    }
}
