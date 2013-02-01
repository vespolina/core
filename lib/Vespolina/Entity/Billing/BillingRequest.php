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
use Vespolina\Entity\Order\ItemInterface;
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
    protected $orderItems;
    protected $partner;
    protected $paymentProfile;
    protected $pricingSet;
    protected $status;

    public function __construct()
    {
        $this->orderItems = array();
        $this->status = self::STATUS_PENDING;
    }

    /**
     * @param $pricingSet
     * @return BillingRequest
     */
    public function setPricingSet($pricingSet)
    {
        $this->pricingSet = $pricingSet;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPricingSet()
    {
        return $this->pricingSet;
    }

    /**
     * @param $amountDue
     * @return BillingRequest
     */
    public function setAmountDue($amountDue)
    {
        $this->amountDue = $amountDue;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmountDue()
    {
        return $this->amountDue;
    }

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

    public function addOrderItem(ItemInterface $item)
    {
        $this->orderItems[] = $item;
    }

    public function getOrderItems()
    {
        return (array) $this->orderItems;
    }

    /**
     * @inheritdoc
     */
    public function mergeOrderItems($items)
    {
        foreach ($items as $item) {
            $this->orderItems[] = $item;
        }
    }

    public function setOrderItems($items)
    {
        $this->orderItems = $items;

        return $this;
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
     * @param \Vespolina\Entity\Pricing\PricingSet $pricingSet
     * @return \Vespolina\Entity\Billing\BillingRequestInterface
     */
    public function setPricing(PricingSetInterface $pricingSet)
    {
        $this->pricingSet = $pricingSet;

        return $this;
    }

    /**
     * @return PricingSet
     */
    public function getPricing()
    {
        return $this->pricingSet;
    }
}
