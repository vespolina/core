<?php

namespace Vespolina\Entity\Partner\PaymentProfileType;

use Vespolina\Entity\Partner\PaymentProfile;

class Invoice extends PaymentProfile
{
    public function getType()
    {
        return self::PAYMENT_PROFILE_TYPE_INVOICE;
    }
}
