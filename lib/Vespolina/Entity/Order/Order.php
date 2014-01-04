<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Order;

use Vespolina\Entity\Channel\ChannelInterface;

class Order extends BaseOrder implements OrderInterface
{
    const STATE_OPEN = 'open';          //Available for change
    const STATE_LOCKED = 'locked';      //Locked for processing
    const STATE_CLOSED = 'closed';      //Closed after processing
    const STATE_EXPIRED = 'expired';    //Not processed and expired
    const STATE_ABANDONED = 'abandoned'; //Cart was abandoned
    const STATE_CONVERTED = 'converted'; //Cart was converted into a purchase

    protected $channel;
    protected $followUp;
    protected $orderDate;
    protected $paymentInstruction;
    protected $billingAgreements;
    protected $internalNotes;

    public function setBillingAgreements($billingAgreements)
    {
        $this->billingAgreements = $billingAgreements;
    }

    public function getBillingAgreements()
    {
        return $this->billingAgreements;
    }

    /**
     * @inheritdoc
     */
    public function setChannel(ChannelInterface $channel)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getChannel()
    {
        return $this->channel;
    }

    public function setFollowUp($followUp)
    {
        $this->followUp = $followUp;

        return $this;
    }

    public function getFollowUp()
    {
        return $this->followUp;
    }


    public function setPaymentInstruction($paymentInstruction)
    {
        $this->paymentInstruction = $paymentInstruction;

        return $this;
    }

    public function getPaymentInstruction()
    {
        return $this->paymentInstruction;
    }

    public function setOrderDate(\DateTime $orderDate)
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getOrderDate()
    {
        return $this->orderDate;
    }

    public function setInternalNotes($internalNotes)
    {
        $this->internalNotes = $internalNotes;
    }

    public function getInternalNotes()
    {
        return $this->internalNotes;
    }

    public function autoSetCreatedAt()
    {
        if (null === $this->createdAt) {
            $this->createdAt = new \DateTime();
        }
        $this->autoSetUpdatedAt();
    }

    public function autoSetUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
    }
}
