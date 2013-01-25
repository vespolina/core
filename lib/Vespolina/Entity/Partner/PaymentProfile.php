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
}
