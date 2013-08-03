<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Partner;

class Address implements AddressInterface
{
    const INVOICE        = 'INVOICE';
    const DELIVERY       = 'DELIVERY';
    const CONTACT        = 'CONTACT';

    protected $city;
    protected $country;
    protected $id;
    protected $number;
    protected $numbersuffix;
    protected $state;
    protected $street;
    protected $type;
    protected $zipcode;

    public function getId()
    {
        return $this->id;
    }

	/**
	 * {@inheritdoc}
	 */
    public function getType()
    {
        return $this->type;
    }

	/**
	 * {@inheritdoc}
	 */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
    
	/**
	 * {@inheritdoc}
	 */
    public function getStreet()
    {
        return $this->street;
    }

	/**
	 * {@inheritdoc}
	 */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
    public function getNumber()
    {
        return $this->number;
    }

	/**
	 * {@inheritdoc}
	 */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
    public function getNumbersuffix()
    {
        return $this->numbersuffix;
    }

	/**
	 * {@inheritdoc}
	 */
    public function setNumbersuffix($numbersuffix)
    {
        $this->numbersuffix = $numbersuffix;

        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
    public function getZipcode()
    {
        return $this->zipcode;
    }

	/**
	 * {@inheritdoc}
	 */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
    public function getCity()
    {
        return $this->city;
    }

	/**
	 * {@inheritdoc}
	 */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
    public function getState()
    {
        return $this->state;
    }

	/**
	 * {@inheritdoc}
	 */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
    public function getCountry()
    {
        return $this->country;
    }

	/**
	 * {@inheritdoc}
	 */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }
}