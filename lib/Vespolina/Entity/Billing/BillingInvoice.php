<?php

namespace Vespolina\Entity\Billing;
use Vespolina\Entity\Order\Order;
use Vespolina\Entity\Invoice\Invoice;

class BillingInvoice implements BillingInvoiceInterface
{

    const STATUS_PENDING = 'Pending';
    const STATUS_PAID = 'Paid';
    const STATUS_CANCELLED = 'Cancelled';

    protected $id;
    protected $order;
    protected $dueDate;
    protected $createdAt;
    protected $amountDue;
    protected $invoice;
    protected $status;

    /**
     * @param $id
     * @return BillingInvoiceInterface
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
     * @param Order $order
     * @return BillingInvoiceInterface
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param \DateTime $date
     * @return BillingInvoiceInterface
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
     * @return BillingInvoiceInterface
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
     * @return BillingInvoiceInterface
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
     * @return BillingInvoiceInterface
     */
    public function setInvoice(Invoice $invoice)
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
     * @return BillingInvoiceInterface
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
}
