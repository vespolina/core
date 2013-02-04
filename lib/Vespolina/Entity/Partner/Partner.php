<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Partner;

use Doctrine\Common\Collections\ArrayCollection;
use Vespolina\Entity\Partner\PaymentProfileInterface;

/**
 * Implementation of PartnerInterface
 *
 * @author Willem-Jan Zijderveld <willemjan@beeldspraak.com>
 */
class Partner implements PartnerInterface
{
    const INDIVIDUAL       = 'individual';
    const ORGANISATION     = 'organisation';
    
    const ROLE_CUSTOMER    = 'ROLE_CUSTOMER';
    const ROLE_EMPLOYEE    = 'ROLE_EMPLOYEE';
    const ROLE_SUPPLIER    = 'ROLE_SUPPLIER';

    const PAYMENT_PROFILE_TYPE_CREDIT_CARD = 'Credit Card';
    const PAYMENT_PROFILE_TYPE_INVOICE = 'Invoice';

    protected $addresses;
    protected $currency;
    protected $id;
    protected $language;
    protected $name;
    protected $shortName;
    protected $organisationDetails;
    protected $partnerId;
    protected $partnerSince;
    protected $paymentTerms;
    protected $personalDetails;
    protected $primaryContact;
    protected $roles;
    protected $type;
    protected $preferredPaymentProfile;
    protected $paymentProfiles;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->paymentProfiles = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getPartnerId()
    {
        return $this->partnerId;
    }

    /**
     * @inheritdoc
     */
    public function setPartnerId($partnerId)
    {
        $this->partnerId = $partnerId;

        return $this;
    }
    
    /**
     * @inheritdoc
     */
    public function getPartnerSince()
    {
        return $this->partnerSince;
    }
    
    /**
     * @inheritdoc
     */
    public function setPartnerSince(\DateTime $partnerSince)
    {
        $this->partnerSince = $partnerSince;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @inheritdoc
     */
    public function addRole($role)
    {
        $this->roles[] = $role;

        return $this;
    }
    
    /**
     * @inheritdoc
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
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
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @inheritdoc
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }
    
    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @inheritdoc
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @inheritdoc
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @inheritdoc
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPaymentTerms()
    {
        return $this->paymentTerms;
    }

    /**
     * @inheritdoc
     */
    public function setPaymentTerms($paymentTerms)
    {
        $this->paymentTerms = $paymentTerms;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * @inheritdoc
     */
    public function setAddresses($addresses)
    {
        $this->addresses = $addresses;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addAddress($address)
    {
        $this->addresses[] = $address;

        return $this;
    }
    
    /**
     * @inheritdoc
     */
    public function removeAddress($address)
    {
        unset($this->addresses[array_find($address)]);
    }

    /**
     * @inheritdoc
     */
    public function getPrimaryContact()
    {
        return $this->primaryContact;
    }

    /**
     * @inheritdoc
     */
    public function setPrimaryContact(Contact $primaryContact)
    {
        $this->primaryContact = $primaryContact;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPersonalDetails()
    {
        return $this->personalDetails;
    }

    /**
     * @inheritdoc
     */
    public function setPersonalDetails($personalDetails)
    {
        $this->personalDetails = $personalDetails;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getOrganisationDetails()
    {
        return $this->organisationDetails;
    }

    /**
     * @inheritdoc
     */
    public function setOrganisationDetails($organisationDetails)
    {
        $this->organisationDetails = $organisationDetails;

        return $this;
    }

    /**
     * Checks if require a billing setup
     *
     * @return bool
     */
    public function isRequireBillingSetup()
    {
        if ($this->getPreferredPaymentProfile()->getType() == self::PAYMENT_PROFILE_TYPE_CREDIT_CARD) {
            return !(boolean)$this->getPreferredPaymentProfile();
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function getPaymentProfiles()
    {
        return $this->paymentProfiles;
    }

    /**
     * @inheritdoc
     */
    public function setPaymentProfiles($paymentProfiles)
    {
        $this->paymentProfiles = $paymentProfiles;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addPaymentProfile($paymentProfile)
    {
        $this->paymentProfiles[] = $paymentProfile;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function removePaymentProfile($paymentProfile)
    {
        unset($this->paymentProfiles[array_find($paymentProfile)]);
    }

    public function setPreferredPaymentProfile(PaymentProfileInterface $paymentProfile)
    {
        $this->preferredPaymentProfile = $paymentProfile;

        return $this;
    }

    /**
     * @return \Vespolina\Entity\Partner\PaymentProfileInterface
     */
    public function getPreferredPaymentProfile()
    {
        return $this->preferredPaymentProfile;
    }
}
