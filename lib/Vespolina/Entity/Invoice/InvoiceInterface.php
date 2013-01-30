<?php
/**
 * (c) 2012-2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Invoice;

use Vespolina\Entity\Order\OrderInterface;
use Vespolina\Entity\Partner\PartnerInterface;

/**
 * An interface for an invoice for an order
 *
 * @author Richard Shank <develop@zestic.com>
 */
interface InvoiceInterface
{
    /**
     * Set the due date of this invoice
     *
     * @param \DateTime $dueDate
     * @return $this
     */
    function setDueDate(\DateTime $dueDate);

    /**
     * Return the due date of this invoice
     *
     * @return \DateTime $dueDate
     */
    function getDueDate();

    /**
     * Set the issued date of this invoice
     *
     * @param \DateTime $issuedDate
     * @return $this
     */
    function setIssuedDate(\DateTime $issuedDate);

    /**
     * Return the issue date of this invoice
     *
     * @return \DateTime $dueDate
     */
    function getIssuedDate();

    /**
     * Add an order to be billed in this invoice
     *
     * @param \Vespolina\Entity\Order\OrderInterface $order
     * @return $this
     */
    function addOrder(OrderInterface $order);

    /**
     * Remove all orders from this invoice
     *
     * @return $this
     */
    function clearOrders();

    /**
     * Return the orders with this invoice
     *
     * @return array
     */
    function getOrders();

    /**
     * Merge a group of orders with the orders in this invoice
     *
     * @param array $orders
     * @return $this
     */
    function mergeOrders(array $orders);

    /**
     * Remove a specific order from the invoice
     *
     * @param \Vespolina\Entity\Order\OrderInterface $order
     * @return $this
     */
    function removeOrder(OrderInterface $order);

    /**
     * Set a group of orders for this invoice
     *
     * @param array $orders
     * @return $this
     */
    function setOrders(array $orders);

    /**
     * Set the Partner getting billed with this invoice
     *
     * @param \Vespolina\Entity\Partner\PartnerInterface $partner
     * @return $this
     */
    function setPartner(PartnerInterface $partner);

    /**
     * Return the partner getting billed in this invoice
     *
     * @return \Vespolina\Entity\Partner\PartnerInterface
     */
    function getPartner();

    /**
     * Set the payment information from the billing
     *
     * @param $payment
     * @return $this
     */
    function setPayment($payment);

    /**
     * Return the payment information for this billing
     *
     * @return
     */
    function getPayment();

    /**
     * Set the end of the billing period for this invoice
     *
     * @param \DateTime $periodEnd
     * @return $this
     */
    function setPeriodEnd(\DateTime $periodEnd);

    /**
     * Return the end of the billing period of this invoice
     *
     * @return \DateTime
     */
    function getPeriodEnd();

    /**
     * Set the start of the billing period for this invoice
     *
     * @param \DateTime $periodEnd
     * @return $this
     */
    function setPeriodStart(\DateTime $periodStart);

    /**
     * Return the start of the billing period of this invoice
     *
     * @return \DateTime
     */
    function getPeriodStart();
        
    /**
     * Set previously created Invoice for the Partner, can be used for reporting
     *
     * @param \Vespolina\Entity\Partner\InvoiceInterface $previousInvoice
     * @return $this
     */
    function setPreviousInvoice(InvoiceInterface $previousInvoice);

    /**
     * Return the previous invoice for the Partner
     *
     * @return \Vespolina\Entity\Partner\InvoiceInterface
     */
    function getPreviousInvoice();

    /**
     * @return boolean
     */
    function isPaid();

    /**
     * @param boolean $paid
     * @return \Vespolina\Entity\Partner\InvoiceInterface
     */
    function setPaid($paid);

}
