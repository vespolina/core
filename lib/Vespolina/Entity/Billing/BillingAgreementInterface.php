<?php
/**
 * (c) 2012-2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Billing;

use Vespolina\Entity\Order\ItemInterface;
use Vespolina\Entity\Order\OrderInterface;
use Vespolina\Entity\Partner\PartnerInterface;

/**
 * An interface for a request to bill a party
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface BillingAgreementInterface
{

    /**
     * Return the last date which already was billed
     * This is the billing period end date of the latest billing request
     *
     * @return mixed
     */
    function getBilledToDate();

    function setBilledToDate(\DateTime $billToDate);

    /**
     * Return the billing amount to be charged on each interval
     *
     * @return integer
     */
    function getBillingAmount();

    /**
     * Set the billing amount to be charged on each cycle
     *
     * @param $billingAmount
     * @return $this
     */
    function setBillingAmount($billingAmount);

    /**
     * Return the number of billing cycles
     * If the billing cycles is -1 it is considered infinite
     *
     * @return integer
     */
    function getBillingCycles();

    function setBillingCycles($billingCycles);

    /**
     * Return the billing interval (day, month, year)
     * eg.  when should the billing cycle reoccur
     *
     * @return string
     */
    function getBillingInterval();

    function setBillingInterval($billingInterval);

    function computeNextCycle();

    /**
     * Generate a new date from a starting date plus an offset
     *
     * @param \DateTime $start
     * @param $offset
     * @return \DateTime
     */
    function dateFromOffset(\DateTime $start, $offset);

    /**
     * Get the initial (first) billing date for this billing agreement
     * The billing period start date for the first billing request to this billing agreement will be set to this date
     *
     * @return mixed
     */
    function getInitialBillingDate();

    function setInitialBillingDate(\DateTime $initialBillingDate);

    /**
     * Get the entity (eg. order) with resulted into this billing agreement
     *
     * @return mixed
     */
    function getOrder();

    function setOrder(OrderInterface $order);

    function getOrderItems();

    function setOrderItems($items);

    /**
     * The owner of this billing agreement (eg. customer)
     *
     * @return PartnerInterface
     */
    function getOwner();

    function setOwner(PartnerInterface $owner);

    /**
     * The payment gateway to be used for this billing agreement
     *
     * @return mixed
     */
    function getPaymentGateway();
    
    function setPaymentGateway($paymentGateway);

}
