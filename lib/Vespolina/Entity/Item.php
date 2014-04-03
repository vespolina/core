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
    protected $prices;
    protected $quantity;

    public function __construct()
    {
        $this->prices[] = [
            'type'  => 'unit',
            'value' => 0,
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
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function clearPrices()
    {
        $this->prices = array();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice($type = 'unit')
    {
        foreach ($this->prices as $price) {
            if ($price['type'] == $type) {
                return $price['value'];
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * {@inheritdoc}
     */
    public function mergePrices($prices)
    {
        foreach ($prices as $price) {
            $this->setPrice($price['value'], $price['type']);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setPrice($value, $type = 'unit')
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
     * {@inheritdoc}
     */
    public function setPrices($prices)
    {
        $this->clearPrices();

        return $this->mergePrices($prices);
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