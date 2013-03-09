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

    const PROCESSING_UNPROCESSED = 0;
    const PROCESSING_FINISHED = 1;

    public function __construct(array $customReturns = array(), array $globalPricingElements = array())
    {
        $defaultReturns = array(
            'discounts', 'netValue', 'surcharge', 'taxes', 'totalValue'
        );
        $this->returns = array_merge($defaultReturns, $customReturns);

        foreach ($this->returns as $return) {
            $this->processed[$return] = null;
        }

        $this->addPricingElements($globalPricingElements);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDiscounts()
    {
        return $this->get('discounts');
    }

    public function getNetValue()
    {
        return $this->get('netValue');
    }

    public function getSurcharge()
    {
        return $this->get('surcharge');
    }

    public function getTaxes()
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

    public function getContext()
    {
        return $this->context;
    }

    public function addPricingElement(PricingElementInterface $element)
    {
        $this->pricingElements[] = $element;
        $element->setPricingSet($this);

        return $this;
    }

    public function addPricingElements(array $elements)
    {
        foreach ($elements as $element) {
            $this->addPricingElement($element);
        }

        return $this;
    }

    public function setPricingElements($pricingElements)
    {
        $this->pricingElements = $pricingElements;
    }

    /**
     * @inheritdoc
     */
    public function all()
    {
        if (!$this->pricingElements) {
            return array();
        }
        $elements = $this->pricingElements;
        $returnElements = array();
        foreach ($elements as $element) {
            $position = $element->getPosition();
            while (isset($returnElements[$position])) {
                $position ++;
            }
            $returnElements[$position] = $element;
        }
        ksort($returnElements);

        return $returnElements;
    }

    public function setProcessed($processed)
    {
        $this->processed = $processed;

        return $this;
    }

    public function getProcessed()
    {
        return $this->processed;
    }

    public function setProcessingState($processingState)
    {
        $this->processingState = $processingState;

        return $this;
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
