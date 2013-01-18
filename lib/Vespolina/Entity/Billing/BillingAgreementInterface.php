<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Billing;

use Vespolina\Entity\Order\OrderInterface;

/**
 * An interface for a request to bill a party
 *
 * @author Daniel Kucharski <daniel-xerias.be>
 */
interface BillingAgreementInterface
{
    /**
     * Get the billing amount to be charged periodically
     *
     * @return integer
     */
    function getBillingAmount();

    /**
     * Get the number of billing cycles
     *
     *
     * @return integer
     */
    function getBillingCycles();

    /**
     * Get the interval (day, month, year)
     *
     * @return integer
     */
    function getBillingInterval();

    /*
     * Get the date when the first billing request should be created
     *
     */
    function getPlannedDate();
}