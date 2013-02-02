<?php

namespace Vespolina\Entity\Partner\PaymentProfileType;

use Vespolina\Entity\Partner\PaymentProfile;
use Vespolina\Entity\Partner\Partner;

class Invoice extends PaymentProfile implements PaymentProfileTypeInterface
{
    public function getType()
    {
        return Partner::PAYMENT_PROFILE_TYPE_INVOICE;
    }
}
