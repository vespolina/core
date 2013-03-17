<?php

namespace Vespolina\Entity\Payment\PaymentProfile;

use Vespolina\Entity\Payment\PaymentProfile;

class Invoice extends PaymentProfile
{
    public function getType()
    {
        return 'Invoice';
    }
}
