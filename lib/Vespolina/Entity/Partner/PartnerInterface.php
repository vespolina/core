<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Partner;

/**
 * Partner interface, define basic fields
 * 
 * @author Willem-Jan Zijderveld <willemjan@beeldspraak.com>
 */
interface PartnerInterface
{
    /**
     * Sets the partnerId
     * 
     * @param string $partnerId
     */
    function setPartnerId($partnerId);
    
    /**
     * Functional partner id
     * 
     * @return string
     */
    function getPartnerId();
    
    /**
     * Date since when this partner joined
     * @param DateTime $partnerSince
     */
    function setPartnerSince(\DateTime $partnerSince);
    
    /**
     * @return DateTime
     */
    function getPartnerSince();

    /**
     * THe role of the Partner (e.g. Customer, Supplier, Employee)
     * @return string
     */
    function getRoles();
    
    /**
     * Adds a role to the current Partner
     * 
     * @param string $role
     */
    function addRole($role);
    
    /**
     * Sets the roles of the partner
     * 
     * @param array $roles
     */
    function setRoles($roles);

    /**
     * Sets the name of the partner
     * 
     * @param string $ame
     */
    function setName($name);
    
    /**
     * Name for partner
     * 
     * @return string
     */
    function getName();

    /**
     * Sets the partners default currency (ISO-4217)
     * @param string $currency
     */
    function setCurrency($currency);
    
    /**
     * Default currency for partner
     * 
     * @return string - ISO-4217
     */
    function getCurrency();
    
    /**
     * Sets the partners default language
     * 
     * @param string $language - IETF tag
     */
    function setLanguage($language);
    
    /**
     * Default language for partner
     * 
     * @return string - IETF tag
     */
    function getLanguage();
    
    /**
     * Sets the default payment terms for customer
     * 
     * @param string $paymentTerms
     */
    function setPaymentTerms($paymentTerms);
    
    /**
     * Default payment terms for partner
     */
    function getPaymentTerms();
    
    /**
     * Sets the partners type
     * 
     * @param string $type
     */
    function setType($type);
    
    /**
     * Discriminator field
     * 
     * @return string
     */
    function getType();
    
    /**
     * Sets the partners addresses
     * 
     * @param \Vespolina\Entity\Partner\Address[] $addresses
     */
    function setAddresses($addresses);
    
    /**
     * Adds a partners address
     * 
     * @param \Vespolina\Entity\Partner\Address $address
     */
    function addAddress($address);
    
    /**
     * Addresses for this account
     * 
     * @return \Vespolina\Entity\Partner\Address[]
     */
    function getAddresses();
    
    /**
     * Sets the partners primary contact
     * 
     * @param \Vespolina\Entity\Partner\Contact $contact
     */
    function setPrimaryContact(Contact $contact);
    
    /**
     * Primary Contact for this accounts
     * 
     * @return \Vespolina\Entity\Partner\Contact
     */
    function getPrimaryContact();
    
    /**
     * Sets the personal details for this partner
     * 
     * @param $personalDetails
     */
    function setPersonalDetails($personalDetails);
    
    /**
     * Personal details of partner (used for type individual)
     * 
     * @return mixed
     */
    function getPersonalDetails();
    
    /**
     * Sets the organistaion details
     * 
     * @param $organisationDetails
     */
    function setOrganisationDetails($organisationDetails);
    
    /**
     * The organistaion details for this partner (used for type organisation)
     * 
     * @return mixed
     */
    function getOrganisationDetails();
}