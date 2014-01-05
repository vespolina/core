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
    protected $parent;
    protected $price;
    protected $quantity;

    public function __construct()
    {
        $this->price = [
            'unit' => 0,
        ];
    }

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
    public function setPrice($value, $type = 'unit')
    {
        $this->price[$type] = $value;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPrice($type = 'unit')
    {
        return $this->price[$type];
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