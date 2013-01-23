<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Pricing;

use Vespolina\Entity\Pricing\PricingSetInterface;

class PricingSet implements PricingSetInterface
{
    protected $pricingElements;

    public function __construct()
    {
        $this->pricingElements = array();
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function get($name)
    {
        if (array_key_exists($name, $this->pricingElements)) {
            return $this->pricingElements[$name];
        }
    }

    public function set($name, $value)
    {
        $this->pricingElements[$name] = $value;
    }

    public function setAll($pricingElements)
    {
        $this->pricingElements = $pricingElements;
    }

    /**
     * @inheritdoc
     */
    public function all()
    {
        return $this->pricingElements;
    }

    function getNetValue()
    {
        // TODO: Implement getNetValue() method.
    }

    function getTotalValue()
    {
        // TODO: Implement getTotalValue() method.
    }
}