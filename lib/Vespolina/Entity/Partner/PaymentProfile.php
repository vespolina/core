<?php

namespace Vespolina\Entity\Partner;

use Vespolina\Entity\Partner\PartnerInterface;

class PaymentProfile implements PaymentProfileInterface
{
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
    protected $billingCountry;
    protected $billingState;
    protected $billingAddress;
    protected $billingZipCode;
    protected $billingPhone;

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

    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    public function setBillingZipCode($billingZipCode)
    {
        $this->billingZipCode = $billingZipCode;
    }

    public function getBillingZipCode()
    {
        return $this->billingZipCode;
    }

    public function setBillingCity($billingCity)
    {
        $this->billingCity = $billingCity;
    }

    public function getBillingCity()
    {
        return $this->billingCity;
    }

    public function setBillingCountry($billingCountry)
    {
        $this->billingCountry = $billingCountry;
    }

    public function getBillingCountry()
    {
        return $this->billingCountry;
    }

    public function setBillingPhone($billingPhone)
    {
        $this->billingPhone = $billingPhone;
    }

    public function getBillingPhone()
    {
        return $this->billingPhone;
    }

    public function setBillingState($billingState)
    {
        $this->billingState = $billingState;
    }

    public function getBillingState()
    {
        return $this->billingState;
    }
}
