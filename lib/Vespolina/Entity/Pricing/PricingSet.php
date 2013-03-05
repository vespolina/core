<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Pricing;

use Vespolina\Entity\Pricing\Element\TotalValueElement;
use Vespolina\Entity\Pricing\PricingElementInterface;
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
        if ($this->processingState != self::PROCESSING_FINISHED) {
            throw new \Exception('Accessing unprocessed pricing element ' . $name);
        }

        if (isset($this->processed[$name])) {
            return $this->processed[$name];
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

    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        return $this->set($offset, $value);
    }

    public function offsetUnset($offset)
    {

    }

}
