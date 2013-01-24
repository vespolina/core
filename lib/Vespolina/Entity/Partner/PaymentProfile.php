<?php

namespace Vespolina\Entity\Partner;

class PaymentProfile
{
    protected $id;
    protected $reference;
    protected $last4digits;

    public function getId()
    {
        return $this->id;
    }

    public function setLast4digits($last4digits)
    {
        $this->last4digits = $last4digits;
    }

    public function getLast4digits()
    {
        return $this->last4digits;
    }

    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    public function getReference()
    {
        return $this->reference;
    }
}
