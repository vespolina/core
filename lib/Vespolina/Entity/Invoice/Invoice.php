<?php
/**
 * (c) 2012-2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Invoice;

use Vespolina\Entity\Invoice\InvoiceInterface;
use Vespolina\Entity\Order\OrderInterface;

/**
 * Invoice for an order
 *
 * @author Richard Shank <develop@zestic.com>
 */
class Invoice implements InvoiceInterface
{
    protected $dueDate;
    protected $issuedDate;
    protected $orders;
    protected $partner;
    protected $payment;
    protected $previousInvoice;

    /**
     * @inheritdoc
     */
    public function addOrder(OrderInterface $order)
    {
        $this->orders[] = $order;
    }

    /**
     * @inheritdoc
     */
    public function clearOrders()
    {
        $this->orders = array();
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
    }

    /**
     * @inheritdoc
     */
    public function setOrders($orders)
    {
        $this->orders = $orders;
    }
}
