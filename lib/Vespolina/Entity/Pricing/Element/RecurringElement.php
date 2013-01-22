<?php
/**
 * (c) 2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\Entity\Pricing\Element;

use Vespolina\Entity\Pricing\PricingElement;

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
        $processed['netValue'] = $this->attribute['netValue'];

        return $processed;
    }
}
