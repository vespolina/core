<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
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
        $this->properties['cycles']  = '';
        $this->values['recurringCharge'] = '';
        $this->properties['interval']  = '';
        $this->properties['startsIn'] = null;

        parent::__construct();
    }

    public function setCycles($cycles)
    {
        $this->properties['cycles'] = $cycles;

        return $this;
    }

    public function getCycles()
    {
        return $this->properties['cycles'];
    }

    public function setInterval($interval)
    {
        $this->properties['interval'] = $interval;

        return $this;
    }

    public function getInterval()
    {
        return $this->properties['interval'];
    }

    public function setRecurringCharge($recurringCharge)
    {
        $this->values['recurringCharge'] = $recurringCharge;

        return $this;
    }

    public function getRecurringCharge()
    {
        return $this->values['recurringCharge'];
    }

    public function setStartsIn($startsIn)
    {
        $this->properties['startsIn'] = $startsIn;

        return $this;
    }

    public function getStartsIn()
    {
        return $this->properties['startsIn'];
    }

    protected function doProcess($context, $processed)
    {
        $processed['values']['recurringCharge'] = $this->values['recurringCharge'];
        $processed['properties']['interval'] = $this->properties['interval'];
        $processed['properties']['cycles'] = $this->properties['cycles'];
        if (!$this->properties['startsIn']) {
            $startsOn = new \DateTime('today +' . $processed['properties']['interval']);
        } else {
            $startsOn = new \DateTime('today +' . $this->properties['startsIn']);
        }
        $processed['properties']['startsOn'] = $startsOn->format('c');

        return $processed;
    }
}
