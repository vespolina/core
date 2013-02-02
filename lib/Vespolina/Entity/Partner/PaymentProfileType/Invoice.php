<?php

namespace Vespolina\Entity\Partner\PaymentProfileType;

use Vespolina\Entity\Partner\PaymentProfile;

class Invoice extends PaymentProfile implements PaymentProfileTypeInterface
{
    public function getType()
    {
        return 'Invoice';
    }
}
