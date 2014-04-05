<?php

/**
 * (c) 2014 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Payment\PaymentProfile;

use Vespolina\Entity\Payment\PaymentProfile;

class BankTransfer extends PaymentProfile
{
    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'Bank Transfer';
    }
}
