<?php
/**
 * (c) 2012-2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Order;

use Vespolina\Entity\Channel\ChannelInterface;
use Vespolina\Entity\Order\BaseOrder;

class Order extends BaseOrder implements OrderInterface
{
    const STATE_OPEN = 'open';          //Available for change
    const STATE_LOCKED = 'locked';      //Locked for processing
    const STATE_CLOSED = 'closed';      //Closed after processing
    const STATE_EXPIRED = 'expired';    //Unprocessed and expired

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
     * @param mixed $channel
     */
    public function setChannel(ChannelInterface $channel)
    {
        $this->channel = $channel;
    }

    /**
     * @return mixed
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @inheritdoc
     */
    public function getFollowUp()
    {
        return $this->followUp;
    }

    public function setPaymentInstruction($paymentInstruction)
    {
        $this->paymentInstruction = $paymentInstruction;
    }

    public function getPaymentInstruction()
    {
        return $this->paymentInstruction;
    }

    /**
     * @inheritdoc
     */
    public function setFollowUp($followUp)
    {
        $this->followUp = $followUp;
    }

    public function setOrderDate(\DateTime $orderDate)
    {
        $this->orderDate = $orderDate;
    }

    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @inheritdoc
     */
    public function setPrice($name, $price)
    {
        $this->prices[$name] = $price;
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
