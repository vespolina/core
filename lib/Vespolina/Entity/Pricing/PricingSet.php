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
    protected $id;
    protected $context;
    protected $processedProperties;
    protected $processedValues;
    protected $processingState = self::PROCESSING_UNPROCESSED;
    protected $returnValues;
    protected $pricingElements;
    protected $valueElement;

    const PROCESSING_UNPROCESSED = 0;
    const PROCESSING_FINISHED = 1;

    public function __construct(PricingElementValueInterface $valueElement, array $customValues = array(), array $globalPricingElements = array())
    {
        $defaultValues = array(
            'discounts', 'netValue', 'surcharge', 'taxes', 'totalValue'
        );
        $this->returnValues = array_merge($defaultValues, $customValues);

        foreach ($this->returnValues as $return) {
            $this->processedValues[$return] = null;
        }

        $this->addPricingElements($globalPricingElements);
        $this->valueElement = $valueElement;
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

        if (isset($this->processedValues[$name])) {
            return $this->processedValues[$name];
        }

        if (isset($this->processedProperties[$name])) {
            return $this->processedProperties[$name];
        }
    }

    public function set($name, $value)
    {
        if (array_key_exists($name, $this->processedValues) || (is_object($value))) {
            $this->processedValues[$name] = $value;

            return $this;
        }
        $this->processedProperties[$name] = $value;

        return $this;
    }

    public function has($name)
    {
        return (bool) $this->get($name);
    }

    public function process($context = null)
    {
        // create empty array with keys from $this->processed
        $processed = array(
            'properties' => array(),
            'values' => array(),
        );

        if (count($this->getPricingElements()) !== 0) {
            /** @var \Vespolina\Entity\Pricing\PricingElementInterface $element */
            foreach ($this->getPricingElements() as $element) {
                $processed = array_merge($this->processed, $element->process($context, $processed));
            }
        } else {
            $processed = $this->getProcessed();
        }

        $newSet = new self($this->valueElement);
        $newSet->setProcessedProperties($processed['properties']);
        $newSet->setProcessedValues($processed['values']);
        $newSet->setProcessingState(self::PROCESSING_FINISHED);
        $this->processingState = self::PROCESSING_FINISHED;

        return $newSet;
    }

    public function add($addSet)
    {
        $newSet = new self($this->valueElement);
        $newSet->setProcessedProperties($this->getProcessedProperties());

        if ($addSet instanceof PricingSetInterface) {
            foreach ($addSet->getProcessedValues() as $key => $value) {

                $total = $this->valueElement->add($this->get($key), $value);
                $newSet->set($key, $total);
            }
        } else {
            $newSet->setProcessedValues($this->getProcessedValues());
        }

        $newSet->setProcessingState(self::PROCESSING_FINISHED);

        return $newSet;
    }

    public function setContext($context)
    {
        $this->context = $context;

        return $this;
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
    public function getPricingElements()
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

    public function setProcessedProperties($properties)
    {
        $this->processedProperties = $properties;

        return $this;
    }

    public function getProcessedProperties()
    {
        return $this->processedProperties;
    }

    public function setProcessedValues($values)
    {
        $this->processedValues = $values;

        return $this;
    }

    public function getProcessedValues()
    {
        return $this->processedValues;
    }

    public function getProcessed()
    {
        $processed = array(
            'properties' => $this->processedProperties,
            'values' => $this->processedValues,
        );

        return $processed;
    }

    public function setProcessingState($processingState)
    {
        $this->processingState = $processingState;

        return $this;
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
