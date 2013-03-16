<?php

namespace Vespolina\Entity\Partner\PaymentProfile;

use Vespolina\Entity\Partner\PaymentProfile;

class PayPal extends PaymentProfile
{
    public function getType()
    {
        return 'paypal';
    }
}
