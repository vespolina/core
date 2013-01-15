<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\Entity;

/**
 * @author Richard Shank <develop@zestic.com>
 */
abstract class CreditCardProfile
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
     * @param $month
     * @param $year
     * @return \Vespolina\Entity\CreditCardProfile
     */
    public function setExpiration($month, $year)
    {
        $this->expiration = array('month' => $month, 'year' => $year);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpiration()
    {
        return $this->expiration;
    }
}
