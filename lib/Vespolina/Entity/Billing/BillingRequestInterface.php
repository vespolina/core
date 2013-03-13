<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Billing;

use Vespolina\Entity\Billing\BillingAgreementInterface;
use Vespolina\Entity\Partner\PartnerInterface;

/**
 * An interface for a request to bill a party
 *
 * @author Daniel Kucharski <daniel-xerias.be>
 */
interface BillingRequestInterface
{
    /**
     * Add a billing agreement which originated into this billing request.
     * Multiple business agreements can merge into one billing request
     *
     * @return mixed
     */
    function addBillingAgreement(BillingAgreementInterface $billingAgreement);

    /**
     * Return the list of billing agreements resulting into this billing request
     * @return mixed
     */
    function getBillingAgreements();

    /**
     * Get the date on which the billing was effectively performed
     *
     *
     * @return \DateTime
     */
    function getBillingDate();

    function setBillingDate(\DateTime $billingDate);
    /**
     * Return the partner we would like to bill
     *
     * @return \Vespolina\Entity\Partner\PartnerInterface
     */
    function getOwner();

    function setOwner(PartnerInterface $partner);

    /**
     * Get the earliest moment we can execute this billing request
     *
     * @return \DateTime
     */
    function getPlannedBillingDate();

    function setPlannedBillingDate(\DateTime $plannedBillingDate);

    /**
     * Return if the billing request is blocked from being executed
     *
     * @return boolean
     */
    function isBlocked();
}