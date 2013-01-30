<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Billing;

use ImmersiveLabs\Pricing\Entity\PricingSet;
use Vespolina\Entity\Partner\PartnerInterface;
use Vespolina\Entity\Invoice\Invoice;

/**
 * An interface for a request to bill a party
 *
 * @author Daniel Kucharski <daniel-xerias.be>
 */
interface BillingRequestInterface
{
    /**
     * @param integer $id
     * @return \Vespolina\Entity\Billing\BillingRequestInterface
     */
    function setId($id);

    /**
     * @return integer
     */
    function getId();

    /**
     * @param PricingSet $ps
     * @return \Vespolina\Entity\Billing\BillingRequestInterface
     */
    function setPricingSet(PricingSet $ps);

    /**
     * @return PricingSet
     */
    function getPricingSet();

    /**
     * @param \DateTime $date
     * @return \Vespolina\Entity\Billing\BillingRequestInterface
     */
    function setDueDate(\DateTime $date);

    /**
     * @return \DateTime
     */
    function getDueDate();

    /**
     * @param \DateTime $date
     * @return \Vespolina\Entity\Billing\BillingRequestInterface
     */
    function setCreatedAt(\DateTime $date);

    /**
     * @return \DateTime
     */
    function getCreatedAt();

    /**
     * @param float $amount
     * @return \Vespolina\Entity\Billing\BillingRequestInterface
     */
    function setAmountDue($amount);

    /**
     * @return float
     */
    function getAmountDue();

    /**
     * @param Invoice $invoice
     * @return \Vespolina\Entity\Billing\BillingRequestInterface
     */
    function setInvoice(Invoice $invoice);

    /**
     * @return Invoice
     */
    function getInvoice();

    /**
     * @param string $status
     * @return \Vespolina\Entity\Billing\BillingRequestInterface
     */
    function setStatus($status);

    /**
     * @return string
     */
    function getStatus();

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

    /**
     * @param PartnerInterface $partner
     * @return BillingRequestInterface
     */
    function setPartner(PartnerInterface $partner);

    /**
     * @return PartnerInterface
     */
    function getPartner();
}