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

    const TYPE_STANDARD = 'standard';       //Default invoice, to be paid
    const TYPE_PRO_FORMA = 'pro_forma';     //Legal pro forma document, already paid when the entity was created
    const TYPE_CREDIT_MEMO = 'credit_memo'; //Invoice to credit the customer

    protected $createdAt;
    protected $dueDate;
    protected $id;
    protected $issuedDate;
    protected $fiscalYear;
    protected $orders;
    protected $partner;
    protected $paymentTerms;
    protected $payment;
    protected $reference;   //eg. sales or purchase order #
    protected $type;
    protected $updatedAt;

    public function __construct()
    {
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

    public function setFiscalYear($fiscalYear)
    {
        $this->fiscalYear = $fiscalYear;
    }

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
    public function mergeOrders(array $orders)
    {
        foreach ($orders as $order) {
            $this->orders->add($order);
        }

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

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }



}
