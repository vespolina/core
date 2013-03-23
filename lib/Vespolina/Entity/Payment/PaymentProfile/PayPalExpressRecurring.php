<?php
/**
 * (c) 2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Payment\PaymentProfile;

use Vespolina\Entity\Payment\PaymentProfile;

class PayPalExpressRecurring extends PaymentProfile
{
    public function getType()
    {
        return 'paypal_express_recurring';
    }
}
