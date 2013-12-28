<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Order;

use Vespolina\Entity\Channel\ChannelInterface;
use Vespolina\Entity\Payment\PaymentProfileInterface;
use Vespolina\Entity\Itemable;

/**
 * Order is a base class for shopping cart or sales order
 *
 * @author Daniel Kucharski <daniel@vespolina.org>
 * @author Richard Shank <richard@vespolina.org>
 */
class BaseOrder extends Itemable implements OrderInterface
{
    protected $attributes;
    protected $channel;
    protected $createdAt;
    protected $fulfillment;
    protected $expiresAt;
    protected $id;
    protected $name;
    protected $customer;
    protected $customerNotes;
    /** @var  \Vespolina\Entity\Partner\Partner */
    protected $owner;
    protected $payment;
    protected $pricingSet;
    protected $state;
    protected $totalPrice;
    protected $updatedAt;
    protected $prices;

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
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set the owner
     *
     * @param \Vespolina\Entity\Partner\Partner $owner
     * @return $this
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Return the owner
     *
     * @return \Vespolina\Entity\Partner\Partner
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

    public function setCustomerNotes($customerNotes)
    {
        $this->customerNotes = $customerNotes;
    }

    public function getCustomerNotes()
    {
        return $this->customerNotes;
    }

    /**
     * @inheritdoc
     */
    public function setPrice($name, $price)
    {
        $this->prices[$name] = $price;

        return $this;
    }
}
