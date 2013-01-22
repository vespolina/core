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
        $this->pricingElements->add(new TotalValueElement());
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

        return $this->processed[$name];
    }

    public function set($name, $value)
    {
        $this->processed[$name] = $value;
    }

    public function has($name, $value)
    {
        return isset($this->processed[$name]);
    }

    public function process($context = null)
    {
        // create empty array with keys from $this->processed
        $processed = array();
        /** @var \Vespolina\Entity\Pricing\PricingElementInterface $element */
        foreach ($this->elements as $element) {
            $processed = array_merge($this->processed, $element->process($context, $processed));
        }

        $this->processed = $processed;
        $this->processingState = self::PROCESSING_FINISHED;
    }

    public function addElement(PricingElementInterface $element)
    {
        $this->pricingElements->add($element);
    }


    public function setContext($context)
    {
        $this->context = $context;
    }

    public function getContext()
    {
        return $this->context;
    }

    public function setPricingElements($pricingElements)
    {
        $this->pricingElements = $pricingElements;
    }

    public function getPricingElements()
    {
        return $this->pricingElements;
    }

    public function setProcessed($processed)
    {
        $this->processed = $processed;
    }

    public function getProcessed()
    {
        return $this->processed;
    }

    public function setProcessingState($processingState)
    {
        $this->processingState = $processingState;
    }

    public function getProcessingState()
    {
        return $this->processingState;
    }

    public function setReturns($returns)
    {
        $this->returns = $returns;
    }

    public function getReturns()
    {
        return $this->returns;
    }
}