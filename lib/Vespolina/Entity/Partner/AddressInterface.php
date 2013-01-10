<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\Entity\Partner;

interface AddressInterface
{
    /**
     * Get address type
     * @return string
     */
    function getType();
    
    /**
     * Set type of address - e.g. invoice or delivery
     * @param string $type
     */
    function setType($type);
    
    /**
     * Get street
     */
    function getStreet();
    
    /**
     * Set street
     * @param string $street
     */
    function setStreet($street);
    
    /**
     * Get street number
     */
    function getNumber();
    
    /**
     * Set street number
     * @param integer $number
     */
    
    function setNumber($number);
    
    /**
     * Get streetnumber suffix
     */
    function getNumberSuffix();
    
    /**
     * Set streetnumber suffix
     * @param string $numberSuffix
     */
    function setNumberSuffix($numberSuffix);
    
    /**
     * Get zipcode
     */
    function getZipcode();
    
    /**
     * Set zipcode
     * @param string $zipCode
     */
    function setZipcode($zipCode);
    
    /**
     * Get city
     */
    function getCity();
    
    /**
     * Set city
     * @param string $city
     */
    function setCity($city);
    
    /**
     * Get state / province
     */
    function getState();
    
    /**
     * Set state / province
     * @param string $state
     */
    function setState($state);
    
    /**
     * Get country
     */
    function getCountry();
    
    /**
     * Set country
     * @param string $country
     */
    function setCountry($country);
}