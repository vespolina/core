<?php

namespace ImmersiveLabs\Pricing\Entity\Element;

use ImmersiveLabs\Pricing\Entity\PricingElement;

class RecurringElement extends PricingElement
{
    public function __construct()
    {
        $attribute['cycles']  = '';
        $attribute['interval']  = '';
        $attribute['startsIn'] = null;

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

        return $processed;
    }
}
