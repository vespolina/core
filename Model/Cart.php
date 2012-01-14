<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
/**
 * Cart implements a basic cart implementation
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 */
class Cart implements CartInterface
{
    const STATE_OPEN = 'open';          //Available for change
    const STATE_LOCKED = 'locked';      //Locked for processing
    const STATE_CLOSED = 'closed';      //Closed after processing
    const STATE_EXPIRED = 'expired';    //Unprocessed and expired

    protected $createdAt;
    protected $expiresAt;
    protected $followUp;
    protected $items;
    protected $name;
    protected $owner;
    protected $state;
    protected $subTotal;
    protected $total;
    protected $updatedAt;

    /**
     * Constructor
     */
    public function __construct($name)
    {
        $this->items = new ArrayCollection();
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function addItem(CartItemInterface $cartItem)
    {
        $cartItem->setCart($this);
        $this->items[] = $cartItem;
    }

    /**
     * @inheritdoc
     */
    public function removeItem(CartItemInterface $cartItem)
    {
        foreach ($this->getItems() as $key => $itemToCompare)
        {
            if ($itemToCompare == $cartItem) {
                unset($this->items[$key]);
                $this->calculateTotal();
                break;
            };
        }
    }

    /**
     * @inheritdoc
     */
    public function clearItems()
    {
        $this->items->clear();
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
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @inheritdoc
     */
    public function getFollowUp()
    {
        return $this->followUp;
    }

    /**
     * @inheritdoc
     */
    public function getItem($index)
    {
        if ($index <= count($this->items)) {

            return $this->items[$index-1];
        }
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
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @inheritdoc
     */
    public function getOwner()
    {
        return $this->owner;
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
    public function getState()
    {
        return $this->state;
    }

    /**
     * @inheritdoc
     */
    public function incrementCreatedAt()
    {
        if (null === $this->createdAt) {
            $this->createdAt = new \DateTime();
        }
        $this->updatedAt = new \DateTime();
    }

    /**
     * @inheritdoc
     */
    public function incrementUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
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
    public function setFollowUp($followUp)
    {
        $this->followUp = $followUp;
    }

    /**
     * @inheritdoc
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @inheritdoc
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @inheritdoc
     */
    public function getSubTotal()
    {
        $this->calculateTotal();
        return $this->subTotal;
    }

    /**
     * @inheritdoc
     */
    public function getTotal()
    {
        $this->calculateTotal();
        return $this->total;
    }

    protected function calculateTotal()
    {
        $subTotal = 0;
        foreach ($this->items as $item) {
            $subTotal += $item->getPrice();
        }
        // todo: extra rows like shipping and taxes
        $extraRows = 0;
        $total = $subTotal + $extraRows;
        $this->subTotal = $subTotal;
        $this->total = $total;
    }
}