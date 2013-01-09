<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\Entity\Pricing;

use Vespolina\Entity\Pricing\PricingElementInterface;

class PricingElement implements PricingElementInterface
{
    /** @var integer */
    protected $order;

    /**
     * @inheritdoc
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @inheritdoc
     */
    public function getOrder()
    {
        return $this->order;
    }
}
