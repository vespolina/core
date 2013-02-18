<?php

namespace Vespolina\Entity\Partner\PaymentProfileType;

use Vespolina\Entity\Partner\PaymentProfile;
use Vespolina\Entity\Partner\Partner;

class CreditCard extends PaymentProfile
{
    protected $activeCardNumber;
    protected $activeCVV;
    protected $cardType;
    protected $expiration;
    protected $persistedCardNumber;
    protected $persistedCVV;
    public $cardInformationChanged = false;

    /**
     * @param string $cardNumber
     * @return \Vespolina\Entity\Partner\PaymentProfileType\CreditCard
     */
    public function setCardNumber($cardNumber)
    {
        if ($cardNumber != $this->persistedCardNumber) {
            $this->activeCardNumber = preg_replace('/\D/', '', $cardNumber);
            $this->persistedCardNumber = str_repeat('*', 12) . substr($this->activeCardNumber, -4);
            $this->cardInformationChanged = true;
        }

        return $this;
    }

    /**
     * @param $CVV
     * @return CreditCard
     */
    public function setCVV($CVV)
    {
        if ($CVV != '***' || $CVV != '****') {
            $this->persistedCVV = str_repeat('*', strlen($CVV));
            $this->activeCVV = $CVV;
            $this->cardInformationChanged = true;
        }

        return $this;
    }

    /**
     * @param $CVV
     * @return CreditCard
     */
    public function setCVV($CVV)
    {
        if ($CVV != '***' || $CVV != '****') {
            $this->persistedCVV = str_repeat('*', strlen($CVV));
            $this->activeCVV = $CVV;
            $this->cardInformationChanged = true;
        }

        return $this;
    }

    public function getCardLast4Digits()
    {
        if ($this->persistedCardNumber !== null && strlen($this->persistedCardNumber) == 16) {

            return substr($this->persistedCardNumber, -4);
        }

        throw new \Exception("The persisted card number is not valid");
    }

    /**
     * @param bool $active
     * @return mixed
     */
    public function getCardNumber($active = false)
    {
        if ($active) {

            return $this->activeCardNumber;
        }

        return $this->persistedCardNumber;
    }

    /**
     * @param bool $active
     * @return mixed
     */
    public function getCVV($active = false)
    {
        if ($active) {

            return $this->activeCVV;
        }

        return $this->persistedCVV;
    }

    /**
     * @param $cardType
     * @return \Vespolina\Entity\Partner\PaymentProfileType\CreditCard
     */
    public function setCardType($cardType)
    {
        $this->cardType = $cardType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardType()
    {
        return $this->cardType;
    }

    /**
     * @param \DateTime
     * @return \Vespolina\Entity\Partner\PaymentProfileType\CreditCard
     */
    public function setExpiration(\DateTime $expiration)
    {
        if ($this->expiration !== null && $this->expiration->format('Y-m-d') != $expiration->format('Y-m-d')) {
            $this->cardInformationChanged = true;
        }

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

    public function getType()
    {
        return self::PAYMENT_PROFILE_TYPE_CREDIT_CARD;
    }

    public function isSetup()
    {
        if ($this->getReference() === null || $this->getExpiration() < new \DateTime('now')) {

            return false;
        }

        return parent::isSetup();
    }
}
