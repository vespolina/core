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
interface BillingRequestInterface
{
    /**
     * Get the last date when the billing run was performed for this item
     *
     *
     * @return \DateTime
     */
    function getBillingDate();

    /**
     * Return the partner we would like to bill
     *
     * @return \Vespolina\Entity\Partner\PartnerInterface
     */
    function getBillingParty();

    /**
     * Get the earliest moment we can execute this billing request
     *
     * @return \DateTime
     */
    function getPlannedBillingDate();

    /**
     * Return if the billing request is blocked from being executed
     *
     * @return boolean
     */
    function isBlocked();
}