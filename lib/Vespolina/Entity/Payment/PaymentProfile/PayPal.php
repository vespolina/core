<?php

namespace Vespolina\Entity\Payment\PaymentProfile;

use Vespolina\Entity\Payment\PaymentProfile;

class PayPal extends PaymentProfile
{
    public function getType()
    {
        return 'paypal';
    }
}
