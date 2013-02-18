<?php

namespace Vespolina\Entity\Partner;

use Vespolina\Entity\Partner\PartnerInterface;

class PaymentProfile implements PaymentProfileInterface
{
    const PAYMENT_PROFILE_TYPE_MAIN = 'Main profile';
    const PAYMENT_PROFILE_TYPE_CREDIT_CARD = 'Credit Card';
    const PAYMENT_PROFILE_TYPE_INVOICE = 'Invoice';

    public static $validTypes = array(
        self::PAYMENT_PROFILE_TYPE_CREDIT_CARD,
        self::PAYMENT_PROFILE_TYPE_INVOICE,
    );

    protected $id;
    protected $reference;
    protected $partner;
    protected $billingCity;
    protected $billingCountry = 'US';
    protected $billingState;
    protected $billingAddress;
    protected $billingZipCode;
    protected $billingPhone;
    protected $createdAt;
    protected $updatedAt;

    /**
     * @inheritdoc
     */
    public function setPartner(PartnerInterface $partner)
    {
        $this->partner = $partner;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPartner()
    {
        return $this->partner;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @inheritdoc
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @inheritdoc
     */
    public function setBillingZipCode($billingZipCode)
    {
        $this->billingZipCode = $billingZipCode;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getBillingZipCode()
    {
        return $this->billingZipCode;
    }

    /**
     * @inheritdoc
     */
    public function setBillingCity($billingCity)
    {
        $this->billingCity = $billingCity;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getBillingCity()
    {
        return $this->billingCity;
    }

    /**
     * @inheritdoc
     */
    public function setBillingCountry($billingCountry)
    {
        $this->billingCountry = $billingCountry;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getBillingCountry()
    {
        return $this->billingCountry;
    }

    /**
     * @inheritdoc
     */
    public function setBillingPhone($billingPhone)
    {
        $this->billingPhone = $billingPhone;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getBillingPhone()
    {
        return $this->billingPhone;
    }

    /**
     * @inheritdoc
     */
    public function setBillingState($billingState)
    {
        $this->billingState = $billingState;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getBillingState()
    {
        return $this->billingState;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function autoUpdatedAt()
    {
        $this->updatedAt = new \DateTime('now');
    }

    public function autoCreatedAt()
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @inheritdoc
     */
    public function isSetup()
    {
        if (!$this->getBillingAddress() || !$this->getBillingZipCode() || !$this->getBillingCountry() || !$this->getBillingCity()) {

            return false;
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return self::PAYMENT_PROFILE_TYPE_MAIN;
    }

    public function __clone()
    {
        if ($this->id) {
            $this->id = null;
        }
    }
}
