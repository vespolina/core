<?php

namespace Vespolina\Entity\Partner\PaymentProfile;

use Vespolina\Entity\Partner\PaymentProfile;

class Invoice extends PaymentProfile
{
    public function getType()
    {
        return 'Invoice';
    }
}
