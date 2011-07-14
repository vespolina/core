<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Model;

/** 
 * Cart implements a basic cart implementation
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 */
class Cart implements CartInterface
{

    protected $items;
    protected $name;
    protected $owner;

    /**
     * Constructor
     */
    public function __construct($name)
    {
        $this->items = array();
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function addItem(CartItemInterface $cartItem)
    {
        $this->items[] = $cartItem;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getItem($index)
    {
        if ($index <= count($this->items))
        {

            return $this->items[$index-1];
        }
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
    public function getItems()
    {

        return $this->items;
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
    public function setOwner($owner)
    {

        $this->owner = $owner;
    }
}