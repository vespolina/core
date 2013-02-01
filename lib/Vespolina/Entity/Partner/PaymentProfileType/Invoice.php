<?php

namespace Vespolina\Entity\Partner\PaymentProfileType;

use Vespolina\Entity\Partner\PaymentProfile;

class Invoice extends PaymentProfile implements PaymentProfileTypeInterface
{
    public function __construct()
    {
        $this['process'] = 'billingRequest';
        $this['paymentType'] = $this->getType();
    }

    public function getType()
    {
        return 'Invoice';
    }
}
