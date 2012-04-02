<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity;

use Vespolina\Entity\ItemInterface;

/**
 * OrderInterface is a generic interface for shopping cart or sales order
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
class Order implements OrderInterface
{
    protected $items;
    protected $name;
    protected $owner;
    protected $state;
    protected $totalPrice;

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
        $this->items->clear();
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
        $this->items = array($this->items, $items);
    }

    /**
     * @inheritdoc
     */
    public function removeItem(ItemInterface $item)
    {
        foreach ($this->items as $key => $itemToCompare)
        {
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
    public function getName()
    {
        return $this->name;
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
    public function getState()
    {
        return $this->state;
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
}
