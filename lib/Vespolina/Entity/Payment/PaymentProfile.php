<?php

namespace Vespolina\Entity\Payment;

class PaymentProfile implements PaymentProfileInterface
{
    protected $id;
    protected $reference;

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
}
