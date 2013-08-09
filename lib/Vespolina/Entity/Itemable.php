<?php

namespace Vespolina\Entity;

/**
 * Item class with common logic for the order and invoice items
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
class Itemable implements ItemableInterface
{
    protected $items;

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
    public function getItems()
    {
        return $this->items;
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
    public function addItem(ItemInterface $item)
    {
        $item->setParent($this);
        $this->items[] = $item;
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

        return $this;
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
    public function mergeItems(array $items)
    {
        $this->items = array_merge($this->items, $items);
    }
}