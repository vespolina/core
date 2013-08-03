<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Order;

use Vespolina\Entity\Channel\ChannelInterface;
use Vespolina\Entity\Order\ItemInterface;
use Vespolina\Entity\Order\OrderInterface;
use Vespolina\Entity\Payment\PaymentProfileInterface;

/**
 * Order is a base class for shopping cart or sales order
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
class BaseOrder implements OrderInterface
{
    protected $attributes;
    protected $channel;
    protected $createdAt;
    protected $fulfillment;
    protected $expiresAt;
    protected $id;
    protected $items;
    protected $name;
    protected $owner;
    protected $ownerNotes;
    protected $payment;
    protected $pricingSet;
    protected $state;
    protected $totalPrice;
    protected $updatedAt;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function addAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * @inheritdoc
     */
    public function addAttributes(array $attributes)
    {
        $this->attributes = array_merge($this->attributes, $attributes);
    }

    /**
     * @inheritdoc
     */
    public function clearAttributes()
    {
        $this->attributes = array();
    }

    /**
     * @inheritdoc
     */
    public function getAttribute($name)
    {
        if (isset($this->attributes[$name])) {

            return $this->attributes[$name];
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @inheritdoc
     */
    public function removeAttribute($name)
    {
        unset($this->attributes[$name]);
    }

    /**
     * @inheritdoc
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @inheritdoc
     */
    public function setChannel(ChannelInterface $channel)
    {
        $this->channel = $channel;
    }

    /**
     * @inheritdoc
     */
    public function getChannel()
    {
        return $this->channel;
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
    public function setExpiresAt(\DateTime $expiresAt)
    {
        $this->expiresAt = $expiresAt;
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
    public function setFulfillment($fulfillment)
    {
        $this->fulfillment = $fulfillment;
    }

    /**
     * @inheritdoc
     */
    public function getFulfillment()
    {
        return $this->fulfillment;
    }

    /**
     * @inheritdoc
     */
    public function isEmpty()
    {
        return empty($this->items);
    }

    /**
     * @inheritdoc
     */
    public function addItem(ItemInterface $item)
    {
        $item->setParent($this);
        $this->items[] = $item;
    }

    /**
     * @inheritdoc
     */
    public function clearItems()
    {
        $this->items = array();
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
    public function mergeItems(array $items)
    {
        $this->items = array_merge($this->items, $items);
    }

    /**
     * @inheritdoc
     */
    public function removeItem(ItemInterface $item)
    {
        foreach ($this->items as $key => $itemToCompare) {
            if ($itemToCompare == $item) {
                unset($this->items[$key]);
                break;
            };
        }
    }

    /**
     * @inheritdoc
     */
    public function setItems($items)
    {
        $this->items = $items;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
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
    public function setPaymentProfile(PaymentProfileInterface $payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPaymentProfile()
    {
        return $this->payment;
    }

    /**
     * @inheritdoc
     */
    public function getPricing()
    {
        return $this->pricingSet;
    }

    /**
     * @inheritdoc
     */
    public function setPricing($pricingSet)
    {
        $this->pricingSet = $pricingSet;
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
    public function getState()
    {
        return $this->state;
    }

    /**
     * @inheritdoc
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @inheritdoc
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
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

    public function setOwnerNotes($ownerNotes)
    {
        $this->ownerNotes = $ownerNotes;
    }

    public function getOwnerNotes()
    {
        return $this->ownerNotes;
    }


}
