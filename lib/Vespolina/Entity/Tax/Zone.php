<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Tax;

use Doctrine\Common\Collections\ArrayCollection;

use Vespolina\Entity\Tax\CategoryInterface;
use Vespolina\Entity\Tax\RateInterface;

/**
 * @author Daniel Kucharski <daniel@vespolina.org>
 */
class Zone implements ZoneInterface
{
    protected $code;
    protected $country;
    protected $defaultRate;
    protected $name;
    protected $rates;
    protected $strategy;
    protected $state;
    protected $type;

    public function __construct()
    {
        $this->rates = new ArrayCollection();
    }

    /**
     * @inheritdoc
     */
    public function addRate(RateInterface $rate)
    {

        $this->rates->set($rate->getCode(), $rate);
    }
    
    /**
     * @inheritdoc
     */
    public function getCode()
    {

        return $this->code;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {

        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getRates(CategoryInterface $category = null)
    {

       return $this->rates;
    }

    /**
     * @inheritdoc
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;
    }

    public function getStrategy()
    {
        return $this->strategy;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setDefaultRate($defaultRate)
    {
        $this->defaultRate = $defaultRate;
    }

    public function getDefaultRate()
    {
        return $this->defaultRate;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }
}
