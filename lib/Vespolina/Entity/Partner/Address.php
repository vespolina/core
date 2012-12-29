<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
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
    
    protected $type;
    protected $street;
    protected $number;
    protected $numbersuffix;
    protected $zipcode;
    protected $city;
    protected $state;
    protected $country;
    
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
    }
}