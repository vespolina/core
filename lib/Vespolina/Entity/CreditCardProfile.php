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

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setCardNumber($cardNumber)
    {
        $this->activeCardNumber = preg_replace('/\D/', '', $cardNumber);
        $chars = strlen($this->activeCardNumber);
        $this->persistedCardNumber = str_repeat('*', $chars - 4) . substr($this->activeCardNumber, -4);
    }

    public function getCardNumber($type = null)
    {
        if ($type === 'active') {
            return $this->activeCardNumber;
        }
        return $this->persistedCardNumber;
    }

    public function setCardType($cardType)
    {
        $this->cardType = $cardType;
    }

    public function getCardType()
    {
        return $this->cardType;
    }

    public function setExpiration($month, $year)
    {
        $this->expiration = array('month' => $month, 'year' => $year);
    }

    public function getExpiration()
    {
        return $this->expiration;
    }
}
