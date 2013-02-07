<?php

namespace Vespolina\Entity\Pricing\Element;

use Vespolina\Entity\Pricing\PricingElement;

class RecurringElement extends PricingElement
{
    public function __construct()
    {
        $this->attributes['cycles']  = '';
        $this->attributes['recurringCharge'] = '';
        $this->attributes['interval']  = '';
        $this->attributes['startsIn'] = null;

        parent::__construct();
    }

    public function setCycles($cycles)
    {
        $this->attributes['cycles'] = $cycles;

        return $this;
    }

    public function getCycles()
    {
        return $this->attributes['cycles'];
    }

    public function setInterval($interval)
    {
        $this->attributes['interval'] = $interval;

        return $this;
    }

    public function getInterval()
    {
        return $this->attributes['interval'];
    }

    public function setRecurringCharge($recurringCharge)
    {
        $this->attributes['recurringCharge'] = $recurringCharge;

        return $this;
    }

    public function getRecurringCharge()
    {
        return $this->attributes['recurringCharge'];
    }

    public function setStartsIn($startsIn)
    {
        $this->attributes['startsIn'] = $startsIn;

        return $this;
    }

    public function getStartsIn()
    {
        return $this->attributes['startsIn'];
    }

    protected function doProcess($context, $processed)
    {
        $processed['netValue'] = $this->attributes['netValue'];
        $processed['recurringCharge'] = $this->attributes['recurringCharge'];
        $processed['interval'] = $this->attributes['interval'];
        $processed['cycles'] = $this->attributes['cycles'];
        if (!$this->attributes['startsIn']) {
            $processed['startsOn'] = new \DateTime('today +' . $processed['interval']);
        } else {
            $processed['startsOn'] = new \DateTime('today +' . $this->attributes['startsIn']);
        }

        return $processed;
    }
}
