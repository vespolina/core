<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Invoice;

use Vespolina\Entity\Itemable;
use Vespolina\Entity\Order\OrderInterface;
use Vespolina\Entity\Partner\PartnerInterface;

/**
 * Invoice entity
 * Optionally linked to one or multiple orders
 *
 * @author Richard Shank <richard@vespolina.org>
 */
class Invoice extends Itemable implements InvoiceInterface
{
    const TYPE_STANDARD = 'standard';       //Default invoice, to be paid
    const TYPE_PRO_FORMA = 'pro_forma';     //Legal pro forma document, already paid when the entity was created
    const TYPE_CREDIT_MEMO = 'credit_memo'; //Invoice to credit the customer

    protected $createdAt;
    protected $dueDate;
    protected $id;
    protected $issuedDate;
    protected $fiscalYear;
    protected $items;
    protected $orders;
    protected $partner;
    protected $paymentTerms;
    protected $payment;
    protected $reference;   //eg. sales or purchase order #
    protected $type;
    protected $updatedAt;

    public function __construct()
    {
        $this->items = array();
        $this->orders = array();
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
    public function setFiscalYear($fiscalYear)
    {
        $this->fiscalYear = $fiscalYear;
    }

    /**
     * @inheritdoc
     */
    public function getFiscalYear()
    {
        return $this->fiscalYear;
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

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }
}
