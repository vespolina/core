<?php

namespace Vespolina\Entity\Billing;

use Vespolina\Entity\Invoice\Invoice;
use Vespolina\Entity\Order\Order;

interface BillingInvoiceInterface
{
    /**
     * @param integer $id
     * @return BillingInvoiceInterface
     */
    function setId($id);

    /**
     * @return integer
     */
    function getId();

    /**
     * @param Order $order
     * @return BillingInvoiceInterface
     */
    function setOrder(Order $order);

    /**
     * @return Order
     */
    function getOrder();

    /**
     * @param \DateTime $date
     * @return BillingInvoiceInterface
     */
    function setDueDate(\DateTime $date);

    /**
     * @return \DateTime
     */
    function getDueDate();

    /**
     * @param \DateTime $date
     * @return BillingInvoiceInterface
     */
    function setCreatedAt(\DateTime $date);

    /**
     * @return \DateTime
     */
    function getCreatedAt();

    /**
     * @param float $amount
     * @return BillingInvoiceInterface
     */
    function setAmountDue($amount);

    /**
     * @return float
     */
    function getAmountDue();

    /**
     * @param Invoice $invoice
     * @return BillingInvoiceInterface
     */
    function setInvoice(Invoice $invoice);

    /**
     * @return Invoice
     */
    function getInvoice();

    /**
     * @param string $status
     * @return BillingInvoiceInterface
     */
    function setStatus($status);

    /**
     * @return string
     */
    function getStatus();
}
