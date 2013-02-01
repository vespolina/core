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
use Vespolina\Entity\Partner\PaymentProfileInterface;

/**
 * An interface for a request to bill a party
 *
 * @author Daniel Kucharski <daniel-xerias.be>
 */
interface BillingAgreementInterface
{
    /**
     * Set the billing amount of the agreement
     * 
     * @param $billingAmount
     * @return $this
     */
    function setBillingAmount($billingAmount);

    /**
     * Return the billing amount to be charged
     *
     * @return integer
     */
    function getBillingAmount();

    function setBillingCycles($billingCycles);

    /**
     * Return the number of billing cycles
     *
     * @return integer
     */
    function getBillingCycles();

    function setBillingInterval($billingInterval);

    /**
     * Return the billing interval (day, month, year)
     *
     * @return string
     */
    function getBillingInterval();

    function setInitialBillingDate(\DateTime $initialBillingDate);

    /*
     * Return the date when the first billing request should be created
     *
     * @return /DateTime
     */
    function getInitialBillingDate();

    function setOrder(OrderInterface $order);

    function getOrder();

    function setOrderItems($items);

    function getOrderItems();

    function setPartner(PartnerInterface $partner);

    function getPartner();

    function setPaymentProfile(PaymentProfileInterface $paymentProfile);

    /**
     * @return \Vespolina\Entity\Partner\PaymentProfileInterface
     */
    function getPaymentProfile();

    /**
     * This should be called after the creation of the BillingRequest to handled any housekeeping needed. This includes
     * increasing the number of processed cycles and determining if there is a future billing date and setting it or
     * making the agreement inactive, if it has run its course.
     *
     * @return $this
     */
    function setCurrentCycleComplete(BillingRequestInterface $billingRequest);
}