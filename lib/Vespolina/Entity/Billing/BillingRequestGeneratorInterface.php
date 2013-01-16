<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Billing;

use Vespolina\Entity\Billing\BillingDataInterface;
use Vespolina\Entity\Billing\BillingRequestInterface;

/**
 * An interface to generate new billing requests
 *
 * @author Daniel Kucharski <daniel-xerias.be>
 */
interface BillingRequestGeneratorInterface
{
    /*
     *  Generate new billing requests for a collection of subscriptions
     *
     *
     * @return array \Vespolina\Entity\Billing\BillingRequestInterface
     */

    function generate(array BillingDataInterface);
}