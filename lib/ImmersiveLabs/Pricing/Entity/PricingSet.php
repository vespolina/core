<?php

namespace ImmersiveLabs\Pricing\Entity;

use ImmersiveLabs\Pricing\Entity\Element\TotalValueElement;
use Vespolina\Entity\Pricing\PricingElementInterface;
use Vespolina\Entity\Pricing\PricingSetInterface;
use Doctrine\Common\Collections\ArrayCollection;

class PricingSet implements PricingSetInterface
{
    protected $id;
    protected $context;
    protected $processed;
    protected $processingState = self::PROCESSING_UNPROCESSED;
    protected $returns;
    protected $pricingElements;

    const PROCESSING_UNPROCESSED = 0;
    const PROCESSING_FINISHED = 1;

    public function __construct(array $customReturns = array())
    {
        $defaultReturns = array(
            'discounts', 'netValue', 'surcharge', 'taxes', 'totalValue'
        );
        $this->returns = array_merge($defaultReturns, $customReturns);

        foreach ($this->returns as $return) {
            $this->processed[$return] = null;
        }

        $this->pricingElements = new ArrayCollection();
        $this->addPricingElement(new TotalValueElement());
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
        return $this->get('taxes');
    }

    public function getTotalValue()
    {
        return $this->get('totalValue');
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function get($name)
    {
        if ($this->processingState != self::PROCESSING_FINISHED) {
            throw new \Exception();
        }

        if (isset($this->processed[$name])) {
            return $this->processed[$name];
        }

        return null;
    }

    public function set($name, $value)
    {
        $this->processed[$name] = $value;

        return $this;
    }

    public function has($name)
    {
        return isset($this->processed[$name]);
    }

    public function process($context = null)
    {
        // create empty array with keys from $this->processed
        $processed = array();

        if (count($this->getPricingElements()) !== 0) {
            /** @var \Vespolina\Entity\Pricing\PricingElementInterface $element */
            foreach ($this->getPricingElements() as $element) {
                $processed = array_merge($this->processed, $element->process($context, $processed));
            }
        } else {
            $processed = $this->processed;
        }


        $newSet = new self();
        $newSet->setProcessed($processed);
        $newSet->setProcessingState(self::PROCESSING_FINISHED);
        $this->processingState = self::PROCESSING_FINISHED;

        return $newSet;
    }

    public function plus($addSet)
    {
        $newSet = new self();
        $newSet->setProcessed($this->processed);

        if ($addSet instanceof PricingSetInterface) {
            foreach ($addSet->getProcessed() as $key => $value) {
                $total = $this->get($key) + $value;
                $newSet->set($key, $total);
            }
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
        $this->pricingElements->add($element);
        $element->setPricingSet($this);

        return $this;
    }

    public function setPricingElements($pricingElements)
    {
        $this->pricingElements = $pricingElements;

        return $this;
    }

    public function getPricingElements()
    {
        if (!$this->pricingElements) {
            return array();
        }
        $elements = $this->pricingElements->toArray();
        $returnElements = array();
        foreach ($elements as $element) {
            $position = $element->getPosition();
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

    public function getProcessingState()
    {
        return $this->processingState;
    }

    public function setReturns($returns)
    {
        $this->returns = $returns;

        return $this;
    }

    public function getReturns()
    {
        return $this->returns;
    }
}