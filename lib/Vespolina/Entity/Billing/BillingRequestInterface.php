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
     * Add a consumption for this billing request
     * Eg. key = bandwith_consumed, $value = 800 
     */
    function addConsumption($key, $value);    
     
    /**
     * Get the consumption data for this billing request
     * For instance, consumed server traffic, number of app downloads, ... 
     */
    function getConsumption();

    function setConsumption(array $consumption);

    /**
     * Return the start of period we are billing for
     *
     * @return \DateTime
     */
    function getPeriodStart();
    
    function setPeriodStart(\DateTime $periodStart);
    /**
     * Return the end of period we are billing for
     * The period covers the billing request including the end date.
     *
     * Typical use cases:
     * - From 1/1 to 31/1 (European notation) includes 31/1 if only the date is relevant
     * - From 1/1 00:00 to 30/1 : 23:59:59 if time is relevant as well
     * @return \DateTime
     */

    function getPeriodEnd();
    
    function setPeriodEnd(\DateTime $periodEnd);
    /**
     * Get the earliest moment we can startexecuting this billing request
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
