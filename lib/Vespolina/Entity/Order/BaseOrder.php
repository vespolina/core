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
use Vespolina\Entity\Payment\TransactionInterface;
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
    /** @var  \Vespolina\Entity\Partner\Partner */
    protected $customer;
    protected $customerNotes;
    protected $fulfillment;
    protected $expiresAt;
    protected $id;
    protected $prices;
    protected $name;
    protected $state;
    protected $updatedAt;

    public function __construct()
    {
        $this->items = [];
        $this->prices[] = [
            'type' => 'total',
            'value' => 0
        ];
    }

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
    public function setPrice($value, $type = 'total')
    {
        foreach ($this->prices as $key => $price) {
            if ($price['type'] == $type) {
                $this->prices[$key] = ['type' => $type, 'value' => $value];

                return $this;
            }
        }
        $this->prices[] = ['type' => $type, 'value' => $value];

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPrice($type = 'total')
    {
        foreach ($this->prices as $price) {
            if ($price['type'] == $type) {
                return $price['value'];
            }
        }

        return null;
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
        return $this->setPrice($totalPrice, 'total');
    }

    /**
     * @inheritdoc
     */
    public function getTotalPrice()
    {
        return $this->getPrice('total');
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
}
