<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Order;

use Vespolina\Entity\Order\BaseOrder;

/**
 * Cart implements a basic cart implementation
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
class Cart extends BaseOrder implements CartInterface
{
    const STATE_OPEN = 'open';          //Available for change
    const STATE_LOCKED = 'locked';      //Locked for processing
    const STATE_CLOSED = 'closed';      //Closed after processing
    const STATE_EXPIRED = 'expired';    //Unprocessed and expired

    protected $expiresAt;
    protected $followUp;
    protected $name;
    protected $paymentInstruction;
    protected $pricingSet;
    protected $createdAt;
    protected $updatedAt;
    
    /**
     * @inheritdoc
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @inheritdoc
     */
    public function setExpiresAt(\DateTime $expiresAt)
    {
        $this->expiresAt = $expiresAt;
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

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function setPrice($name, $price)
    {
        $this->prices[$name] = $price;
    }

    /**
     * @inheritdoc
     */
    public function getPricingSet()
    {
        return $this->pricingSet;
    }

    /**
     * @inheritdoc
     */
    public function setPricingSet($pricingSet)
    {
        $this->pricingSet = $pricingSet;
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
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    /**
     * @inheritdoc
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
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
        $this->updateAt = new \DateTime();
    }
}
