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
    protected $attributes;
    protected $position = 0;
    protected $pricingSet;
    protected $type;

    public function __construct()
    {
        $attribute['netValue']  = '';
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
    public function process($context)
    {
        return $this->doProcess($context);
    }

    protected function doProcess($context)
    {
        throw new FunctionNotSupportedException('process() has not been implemented in ' . get_class($this));
    }
}
