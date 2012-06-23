<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Model;

use Vespolina\Entity\BaseOrder;
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

    protected $attributes;
    protected $createdAt;
    protected $expiresAt;
    protected $followUp;
    protected $items;
    protected $name;
    protected $owner;
    protected $paymentInstruction;
    protected $pricingSet;
    protected $state;
    protected $totalPrice;
    protected $updatedAt;

    /**
     * Constructor
     */
    public function __construct($name)
    {
        $this->attributes = array();
        $this->items = new ArrayCollection();
        $this->name = $name;
    }

    public function addAttribute($name, $value) {

        $this->attributes[$name] = $value;
    }

    /**
     * @inheritdoc
     */
    public function clearItems()
    {
        $this->items->clear();
    }

    public function getAttribute($name) {

        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }
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
        if ($index <= count($this->getItems())) {

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
    public function getPricingSet()
    {
        return $this->pricingSet;
    }

    /**
     * @inheritdoc
     */
    public function getRecurringItems()
    {
        $recurringItems = array();
        foreach ($this->getItems() as $item) {
            if ($item->isRecurring()) {
                $recurringItems[] = $item;
            }
        }

        return $recurringItems;
    }

    /**
     * @inheritdoc
     */
    public function getNonRecurringItems()
    {
        $nonRecurringItems = array();
        foreach ($this->getItems() as $item) {
            if (!$item->isRecurring()) {
                $nonRecurringItems[] = $item;
            }
        }

        return $nonRecurringItems;
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

    public function setPrice($name, $price)
    {
        $this->prices[$name] = $price;
    }

    /**
     * @inheritdoc
     */
    public function setPricingSet($pricingSet)
    {

        $this->pricingSet = $pricingSet;
    }

    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @inheritdoc
     */
    protected function addItem(CartItemInterface $cartItem)
    {
        $cartItem->setCart($this);
        $this->items[] = $cartItem;
    }

    /**
     * @inheritdoc
     */
    protected function removeItem(CartItemInterface $cartItem)
    {
        foreach ($this->getItems() as $key => $itemToCompare)
        {
            if ($itemToCompare == $cartItem) {
                unset($this->items[$key]);
                break;
            };
        }
    }

    public function isEmpty()
    {
        return $this->getItems()->isEmpty();
    }

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }
}
