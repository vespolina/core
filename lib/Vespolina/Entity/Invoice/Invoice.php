<?php
/**
 * (c) 2012-2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Invoice;

use Doctrine\Common\Collections\ArrayCollection;

use Vespolina\Entity\Invoice\InvoiceInterface;
use Vespolina\Entity\Order\OrderInterface;
use Vespolina\Entity\Partner\PartnerInterface;

/**
 * Invoice for an order
 *
 * @author Richard Shank <develop@zestic.com>
 */
class Invoice implements InvoiceInterface
{
    protected $dueDate;
    protected $id;
    protected $issuedDate;
    protected $orders;
    protected $partner;
    protected $payment;
    protected $periodEnd;
    protected $periodStart;
    protected $previousInvoice;

    public function __construct() {
        $this->orders = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setDueDate(\DateTime $dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @inheritdoc
     */
    public function setIssuedDate(\DateTime $issuedDate)
    {
        $this->issuedDate = $issuedDate;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getIssuedDate()
    {
        return $this->issuedDate;
    }

    /**
     * @inheritdoc
     */
    public function addOrder(OrderInterface $order)
    {
        $this->orders[] = $order;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function clearOrders()
    {
        $this->orders = array();

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @inheritdoc
     */
    public function mergeOrders(array $orders)
    {
        $this->orders = array_merge($this->orders, $orders);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function removeOrder(OrderInterface $order)
    {
        foreach ($this->orders as $key => $orderToCompare) {
            if ($orderToCompare == $order) {
                unset($this->orders[$key]);
                break;
            };
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setOrders(array $orders)
    {
        $this->orders = $orders;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setPartner(PartnerInterface $partner)
    {
        $this->partner = $partner;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPartner()
    {
        return $this->partner;
    }

    /**
     * @inheritdoc
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @inheritdoc
     */
    public function setPeriodEnd(\DateTime $periodEnd)
    {
        $this->periodEnd = $periodEnd;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPeriodEnd()
    {
        return $this->periodEnd;
    }

    /**
     * @inheritdoc
     */
    public function setPeriodStart(\DateTime $periodStart)
    {
        $this->periodStart = $periodStart;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPeriodStart()
    {
        return $this->periodStart;
    }

    /**
     * @inheritdoc
     */
    public function setPreviousInvoice(InvoiceInterface $previousInvoice)
    {
        $this->previousInvoice = $previousInvoice;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPreviousInvoice()
    {
        return $this->previousInvoice;
    }
}
