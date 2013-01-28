<?php

namespace Vespolina\Entity\Partner\PaymentProfileType;

use Vespolina\Entity\Partner\PaymentProfile;

class CreditCard extends PaymentProfile implements PaymentProfileTypeInterface
{
    protected $activeCardNumber;
    protected $address;
    protected $cardType;
    protected $expiration;
    protected $persistedCardNumber;

    /**
     * @param string $address
     * @return \Vespolina\Entity\CreditCardProfile
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $cardNumber
     * @return \Vespolina\Entity\CreditCardProfile
     */
    public function setCardNumber($cardNumber)
    {
        $this->activeCardNumber = preg_replace('/\D/', '', $cardNumber);
        $chars = strlen($this->activeCardNumber);
        $this->persistedCardNumber = str_repeat('*', $chars - 4) . substr($this->activeCardNumber, -4);

        return $this;
    }

    /**
     * @param null $type
     * @return mixed
     */
    public function getCardNumber($type = null)
    {
        if ($type === 'active') {
            return $this->activeCardNumber;
        }
        return $this->persistedCardNumber;
    }

    /**
     * @param $cardType
     * @return \Vespolina\Entity\CreditCardProfile
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
     * @return \Vespolina\Entity\CreditCardProfile
     */
    public function setExpiration(\DateTime $expirationDate)
    {
        $this->expiration = $expirationDate;

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
        return 'Credit Card';
    }
}
