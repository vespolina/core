<?php

namespace Vespolina\Entity;

/**
 * Item class with common logic for the order and invoice items
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
class Item implements ItemInterface
{
    protected $id;
    protected $name;
    protected $pricingSet;
    protected $quantity;
    protected $parent;

    public function getId()
    {
        return $this->id;
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

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setPricing($pricingSet)
    {
        $this->pricingSet = $pricingSet;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPricing()
    {
        return $this->pricingSet;
    }

    protected function setQuantity($quantity)
    {
        $this->quantity = $quantity;
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
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @inheritdoc
     */
    public function setParent(ItemableInterface $parent)
    {
        $this->parent = $parent;

        return $this;
    }
}