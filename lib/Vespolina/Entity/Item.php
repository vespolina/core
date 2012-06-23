<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity;

use Vespolina\Entity\ItemInterface;

/**
 * Item is a class for items in an order
 *
 * @author Richard Shank <develop@zestic.com>
 */
class Item implements ItemInterface
{
    protected $options;
    protected $parent;
    protected $state;

    /**
     * @inheritdoc
     */
    function setParent(OrderInterface $parent)
    {
        $this->parent = $parent;
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
    public function getState()
    {
        return $this->state;
    }

    /**
     * Add a option for the product in this item
     *
     * @param $type string or array with [$type] = $value
     * @param $value or null if $type is an array
     */
    protected function addOption($type, $value = null)
    {

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
}
