<?php
/**
 * (c) 2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Billing;

use Vespolina\Entity\Billing\BillingRequestInterface;
use Vespolina\Entity\Invoice\InvoiceInterface;
use ImmersiveLabs\Pricing\Entity\PricingSet;
use Vespolina\Entity\Partner\PartnerInterface;
use Vespolina\Entity\Partner\PaymentProfileInterface;
use Vespolina\Entity\Pricing\PricingSetInterface;

class BillingRequest implements BillingRequestInterface
{

    const STATUS_PENDING = 'Pending';
    const STATUS_PAID = 'Paid';
    const STATUS_CANCELLED = 'Cancelled';

    protected $amountDue;
    protected $createdAt;
    protected $dueDate;
    protected $id;
    protected $invoice;
    protected $status;
    protected $partner;
    protected $paymentProfile;
    protected $pricingSet;

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \DateTime $date
     * @return $this
     */
    public function setDueDate(\DateTime $date)
    {
        $this->dueDate = $date;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param \DateTime $date
     * @return $this
     */
    public function setCreatedAt(\DateTime $date)
    {
        $this->createdAt = $date;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param float $amount
     * @return $this
     */
    public function setAmountDue($amount)
    {
        $this->amountDue = $amount;

        return $this;
    }

    /**
     * @return float
     */
    public function getAmountDue()
    {
        return $this->amountDue;
    }

    /**
     * @param Invoice $invoice
     * @return $this
     */
    public function setInvoice(InvoiceInterface $invoice)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * @return Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function autoSetCreatedAt()
    {
        if (null === $this->createdAt) {
            $this->createdAt = new \DateTime();
        }

        return $this;
    }

    public function getBillingDate()
    {

    }

    public function getBillingParty()
    {

    }

    public function getPlannedBillingDate()
    {

    }

    public function isBlocked()
    {

    }

    /**
     * @param PartnerInterface $partner
     * @return BillingRequestInterface
     */
    public function setPartner(PartnerInterface $partner)
    {
        $this->partner = $partner;

        return $this;
    }

    /**
     * @return PartnerInterface
     */
    public function getPartner()
    {
        return $this->partner;
    }

    public function setPaymentProfile(PaymentProfileInterface $paymentProfile)
    {
        $this->paymentProfile = $paymentProfile;

        return $this;
    }

    public function getPaymentProfile()
    {
        return $this->paymentProfile;
    }

    /**
     * @param \Vespolina\Entity\Pricing\PricingSet $ps
     * @return \Vespolina\Entity\Billing\BillingRequestInterface
     */
    public function setPricingSet(PricingSetInterface $ps)
    {
        $this->pricingSet = $ps;

        return $this;
    }

    /**
     * @return PricingSet
     */
    public function getPricingSet()
    {
        return $this->pricingSet;
    }
}
