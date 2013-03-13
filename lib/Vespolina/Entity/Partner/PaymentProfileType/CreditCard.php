<?php

namespace Vespolina\Entity\Partner\PaymentProfileType;

use Vespolina\Entity\Partner\PaymentProfile;

class CreditCard extends PaymentProfile
{
    // mapped
    protected $last4digits;

    // not mapped
    protected $cardNumber;
    protected $cvv;
    protected $expiration;
    protected $cardInformationChanged = false;

    /**
     * @param $last4digits
     * @return \Vespolina\Entity\Partner\PaymentProfileType\CreditCard
     */
    public function setLast4digits($last4digits)
    {
        $this->last4digits = $last4digits;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLast4digits()
    {
        return $this->last4digits;
    }

    /**
     * @param $cardNumber
     * @return \Vespolina\Entity\Partner\PaymentProfileType\CreditCard
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = preg_replace('/\D/', '', $cardNumber);

        return $this;
    }

    /**
     * @param $cvv
     * @internal param $CVV
     * @return CreditCard
     */
    public function setCVV($cvv)
    {
        $this->cvv = $cvv;

        return $this;
    }

    /**
     * @internal param bool $active
     * @return mixed
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * @param bool $active
     * @return mixed
     */
    public function getCVV()
    {
        return $this->cvv;
    }

    /**
     * @param \DateTime
     * @return \Vespolina\Entity\Partner\PaymentProfileType\CreditCard
     */
    public function setExpiration(\DateTime $expiration)
    {
        $this->expiration = $expiration;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpiration()
    {
        return $this->expiration;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return self::PAYMENT_PROFILE_TYPE_CREDIT_CARD;
    }

    /**
     * @return bool
     */
    public function isSetup()
    {
        if ($this->getReference() === null) {

            return false;
        }

        return parent::isSetup();
    }

    /**
     * @param $cardInformationChanged
     */
    public function setCardInformationChanged($cardInformationChanged)
    {
        $this->cardInformationChanged = $cardInformationChanged;
    }

    /**
     * @return mixed
     */
    public function getCardInformationChanged()
    {
        return $this->cardInformationChanged;
    }

}
