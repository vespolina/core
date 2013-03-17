<?php

namespace Vespolina\Entity\Partner\PaymentProfile;

use Vespolina\Entity\Partner\PaymentProfile;

class Bitcoin extends PaymentProfile
{
    public function getType()
    {
        return 'bitcoin';
    }
}
