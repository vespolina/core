<?php

namespace Vespolina\Entity\Payment\PaymentProfile;

use Vespolina\Entity\Payment\PaymentProfile;

class Bitcoin extends PaymentProfile
{
    public function getType()
    {
        return 'bitcoin';
    }
}
