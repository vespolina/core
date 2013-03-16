<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Partner;

use Vespolina\Entity\Partner\ContactInterface;

/**
 * Partner interface, define basic fields
 * 
 * @author Willem-Jan Zijderveld <willemjan@beeldspraak.com>
 */
interface PartnerInterface
{
    /**
     * Sets the partners addresses
     * 
     * @param \Vespolina\Entity\Partner\Address[] $addresses
     * @return \Vespolina\Entity\Partner\PartnerInterface
     */
    function setAddresses($addresses);
    
    /**
     * Adds a partners address
     * 
     * @param \Vespolina\Entity\Partner\Address $address
     * @return \Vespolina\Entity\Partner\PartnerInterface
     */
    function addAddress(AddressInterface $address);
    
    /**
     * Addresses for this account
     * 
     * @return \Vespolina\Entity\Partner\Address[]
     */
    function getAddresses();

    /**
     * Sets the partners default currency (ISO-4217)
     * @param string $currency
     * @return \Vespolina\Entity\Partner\PartnerInterface
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
     * @return \Vespolina\Entity\Partner\PartnerInterface
     */
    function setLanguage($language);

    /**
     * Default language for partner
     *
     * @return string - IETF tag
     */
    function getLanguage();

    /**
     * Sets the name of the partner
     *
     * @param string $name
     * @return \Vespolina\Entity\Partner\PartnerInterface
     */
    function setName($name);

    /**
     * Name for partner
     *
     * @return string
     */
    function getName();

    /**
     * Sets the organisation details
     *
     * @param $organisationDetails
     * @return \Vespolina\Entity\Partner\PartnerInterface
     */
    function setOrganisationDetails(OrganisationDetailsInterface $organisationDetails);

    /**
     * The organisation details for this partner (used for type organisation)
     *
     * @return \Vespolina\Entity\Partner\OrganisationDetailsInterface
     */
    function getOrganisationDetails();

    /**
     * Sets the partnerId
     *
     * @param string $partnerId
     * @return \Vespolina\Entity\Partner\PartnerInterface
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
     * @param \DateTime $partnerSince
     * @return \Vespolina\Entity\Partner\PartnerInterface
     */
    function setPartnerSince(\DateTime $partnerSince);

    /**
     * @return \DateTime
     */
    function getPartnerSince();

    /**
     * Sets the default payment terms for customer
     *
     * @param string $paymentTerms
     * @return \Vespolina\Entity\Partner\PartnerInterface
     */
    function setPaymentTerms($paymentTerms);

    /**
     * Default payment terms for partner
     */
    function getPaymentTerms();

    /**
     * Sets the personal details for this partner
     *
     * @param $personalDetails
     * @return \Vespolina\Entity\Partner\PartnerInterface
     */
    function setPersonalDetails($personalDetails);

    /**
     * Personal details of partner (used for type individual)
     *
     * @return \Vespolina\Entity\Partner\PersonalDetailsInterface
     */
    function getPersonalDetails();

    /**
     * Clear all of the payment profiles
     *
     * @return $this
     */
    function clearPaymentProfiles();

    /**
     * Set the preferred payment profile
     *
     * @param \Vespolina\Entity\Partner\PaymentProfileInterface $paymentProfile
     * @return $this
     */
    function setPreferredPaymentProfile(PaymentProfileInterface $paymentProfile);

    /**
     * Return the preferred payment profile
     *
     * @return \Vespolina\Entity\Partner\PaymentProfileInterface
     */
    function getPreferredPaymentProfile();

    /**
     * Sets the partners primary contact
     * 
     * @param \Vespolina\Entity\Partner\ContactInterface $contact
     * @return \Vespolina\Entity\Partner\PartnerInterface
     */
    function setPrimaryContact(ContactInterface $contact);
    
    /**
     * Primary Contact for this accounts
     * 
     * @return \Vespolina\Entity\Partner\Contact
     */
    function getPrimaryContact();

    /**
     * THe role of the Partner (e.g. Customer, Supplier, Employee)
     * @return string
     */
    function getRoles();

    /**
     * Adds a role to the current Partner
     *
     * @param string $role
     * @return \Vespolina\Entity\Partner\PartnerInterface
     */
    function addRole($role);

    /**
     * Sets the roles of the partner
     *
     * @param array $roles
     * @return \Vespolina\Entity\Partner\PartnerInterface
     */
    function setRoles($roles);

    /**
     * Sets the partners type
     *
     * @param string $type
     * @return \Vespolina\Entity\Partner\PartnerInterface
     */
    function setType($type);

    /**
     * Discriminator field
     *
     * @return string
     */
    function getType();
}