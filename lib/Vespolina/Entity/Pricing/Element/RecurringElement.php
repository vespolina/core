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
    protected $cycles;
    protected $interval;
    protected $processed = true;
    protected $startsIn;

    public function setCycles($cycles)
    {
        $this->cycles = $cycles;

        return $this;
    }

    public function getCycles()
    {
        return $this->cycles;
    }

    public function setInterval($interval)
    {
        $this->interval = $interval;

        return $this;
    }

    public function getInterval()
    {
        return $this->interval;
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

    public function setStartsIn($startsIn)
    {
        $this->startsIn = $startsIn;

        return $this;
    }

    public function getStartsIn()
    {
        return $this->startsIn;
    }

}
