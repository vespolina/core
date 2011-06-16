<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Model;

use \DateTime;

class Cart implements CartInterface
{
    protected $createdAt;
    protected $items;
    protected $name;
    protected $owner;
    protected $updatedAt;
    
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
    public function getCreatedAt()
    {

        return $this->createdAt;
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
          if( $index <= count($this->items) )
        {

            return $this->items[$index-1];
        }
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
    public function getUpdatedAt()
    {
        $this->updatedAt = $this->updatedAt;
    }

    /**
     * @inheritdoc
     */
    function setCreatedAt(DateTime $createdAt)
    {

        $this->createdAt = $createdAt;
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
    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

}