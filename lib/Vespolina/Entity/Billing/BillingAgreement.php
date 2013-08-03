<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Billing;

use Doctrine\Common\Collections\ArrayCollection;
use Vespolina\Entity\Billing\BillingAgreementInterface;
use Vespolina\Entity\Partner\PartnerInterface;
use Vespolina\Entity\Order\OrderInterface;
use Vespolina\Entity\Payment\PaymentProfileInterface;

class BillingAgreement implements BillingAgreementInterface
{
    protected $active;
    protected $billingAmount;
    protected $billingCycles;
    protected $billingInterval;
    protected $billedToDate;
    protected $createdAt;
    protected $generateRequestOffset;
    protected $generateRequestOn;
    protected $id;
    protected $initialBillingDate;
    protected $order;
    protected $orderItems;
    protected $owner;
    protected $paymentProfile;
    protected $processRequestOffset;
    protected $numberCyclesBilled;
    protected $updatedAt;

    public function __construct()
    {
        $this->active = true;
        $this->numberCyclesBilled = 0;
        $this->orderItems = array();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setBilledToDate(\DateTime $billedToDate)
    {
        $this->billedToDate = $billedToDate;
    }

    public function getBilledToDate()
    {
        return $this->billedToDate;
    }


    public function autoSetCreatedAt()
    {
        if (null === $this->createdAt) {
            $this->createdAt = new \DateTime();
        }
        $this->autoSetUpdatedAt();

        return $this;
    }

    public function autoSetUpdatedAt()
    {
        $this->updatedAt = new \DateTime();

        return $this;
    }

    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setBillingAmount($billingAmount)
    {
        $this->billingAmount = $billingAmount;

        return $this;
    }

    public function getBillingAmount()
    {
        return $this->billingAmount;
    }

    public function setBillingCycles($billingCycles)
    {
        $this->billingCycles = $billingCycles;

        return $this;
    }

    public function getBillingCycles()
    {
        return $this->billingCycles;
    }

    public function setBillingInterval($billingInterval)
    {
        $this->billingInterval = $billingInterval;

        return $this;
    }

    public function getBillingInterval()
    {
        return $this->billingInterval;
    }

    /**
     * @inheritdoc
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @inheritdoc
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @inheritdoc
     */
    public function computeNextCycle()
    {

    }

    public function dateFromOffset(\DateTime $start, $offset)
    {
        $returnDate = clone $start;
        $returnDate->modify($offset);

        if (stristr($offset, 'month') || stristr($offset, 'year')) {
            $date = (integer) $start->format('d');
            $newDate = (integer) $returnDate->format('d');
            if ($date > 28 && $newDate < 4) {
                $returnDate->modify("-$newDate day");
            }
        }

        return $returnDate;
    }

    public function setInitialBillingDate(\DateTime $initialBillingDate)
    {
        $this->initialBillingDate = $initialBillingDate;

        return $this;
    }

    public function getInitialBillingDate()
    {
        return $this->initialBillingDate;
    }

    public function setOrder(OrderInterface $order)
    {
        $this->order = $order;

        return $this;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setOrderItems($items)
    {
        $this->orderItems = $items;

        return $this;
    }

    public function getOrderItems()
    {
        return $this->orderItems;
    }

    public function addOrderItem(ItemInterface $item)
    {
        $this->orderItems->add($item);
    }

    public function setOwner(PartnerInterface $owner)
    {
        $this->owner = $owner;

        return $this;
    }

    public function getOwner()
    {
        return $this->owner;
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

    public function setNumberCyclesBilled($numberCyclesBilled)
    {
        $this->numberCyclesBilled = $numberCyclesBilled;

        return $this;
    }

    public function getNumberCyclesBilled()
    {
        return $this->numberCyclesBilled;
    }

    public function increaseNumberCyclesBilled()
    {
        $this->numberCyclesBilled++;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @inheritdoc
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @inheritdoc
     */
    public function setGenerateRequestOffset($generateRequestOffset)
    {
        if (!strtotime($generateRequestOffset)) {
            throw new \InvalidArgumentException('String must be a valid PHP DateTime format.');
        }

        $this->generateRequestOffset = $generateRequestOffset;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getGenerateRequestOffset()
    {
        return $this->generateRequestOffset;
    }

    /**
     * @inheritdoc
     */
    public function setProcessRequestOffset($processRequestOffset)
    {
        if (!strtotime($processRequestOffset)) {
            throw new \InvalidArgumentException('String must be a valid PHP DateTime format.');
        }

        $this->processRequestOffset = $processRequestOffset;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getProcessRequestOffset()
    {
        return $this->processRequestOffset;
    }

    /**
     * @inheritdoc
     */
    public function setGenerateRequestOn(\DateTime $generateRequestOn)
    {
        $this->generateRequestOn = $generateRequestOn;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getGenerateRequestOn()
    {
        return $this->generateRequestOn;
    }
}
