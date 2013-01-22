<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Pricing\Entity;

use Vespolina\Entity\Pricing\PricingElementInterface;
use Vespolina\Exception\FunctionNotSupportedException;

class PricingElement implements PricingElementInterface
{
    protected $attributes;
    protected $order;
    protected $type;

    public function __construct()
    {
        $attribute['netValue']  = '';
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
}
