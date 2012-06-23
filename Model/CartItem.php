<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Model\CartItemInterface;

/**
 * CartItem implements a basic cart item implementation
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
abstract class CartItem implements CartItemInterface
{
    protected $cart;
    protected $cartableItem;
    protected $description;
    protected $isRecurring;
    protected $name;
    protected $options;
    protected $paymentInstruction;
    protected $productId;
    protected $pricingSet;
    protected $quantity;
    protected $state;
    protected $totalPrice;

    public function __construct($cartableItem = null)
    {
        $this->cartableItem = $cartableItem;
        $this->isRecurring = false;
        $this->options = array();
        $this->prices = array();
        $this->quantity = 1;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function addOption($type, $value = null)
    {
        if (is_array($type)) {
            $key = key($type);
            $value = $type[$key];
            $type = $key;
        }

        $this->options[$type] = $value;
    }

    /**
     * @inheritdoc
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @inheritdoc
     */
    public function getOption($type)
    {
        if (array_key_exists($type, $this->options)) {

            return $this->options[$type];
        }
    }

    /**
     * @inheritdoc
     */
    public function getOptions()
    {
        return $this->options;
    }


    public function getPricingSet()
    {
        return $this->pricingSet;
    }

    /**
     * @inheritdoc
     */
    public function getCartableItem()
    {
        return $this->cartableItem;
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
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @inheritdoc
     */
    public function setCart(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @inheritdoc
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function setPaymentInstruction($paymentInstruction)
    {
        $this->paymentInstruction = $paymentInstruction;
    }

    public function getPaymentInstruction()
    {
        return $this->paymentInstruction;
    }

    public function setPricingSet($pricingSet)
    {
        $this->pricingSet = $pricingSet;
    }

    /**
     * @inheritdoc
     */
    protected function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @inheritdoc
     */
    protected function setState($state)
    {
        $this->state = $state;
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
    public function isRecurring()
    {
        return $this->isRecurring;
    }

    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }
}
