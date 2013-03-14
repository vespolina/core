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
     * Set the fiscal year to which this invoice should be posted to
     *
     * (eg. you can have an invoice created in January 2014 which should go to fiscal year 2013)
     * @param $fiscalYear
     * @return mixed
     */
    function setFiscalYear($fiscalYear);

    /**
     * Return the fiscal year
     *
     * @return mixed
     */
    function getFiscalYear();
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

}
