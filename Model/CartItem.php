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
use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Model\CartItemInterface;

class CartItem implements CartItemInterface
{
    protected $cart;
    protected $createdAt;
    protected $merchandise;
    protected $quantity;
    protected $status;
    protected $updatedAt;

    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
        $this->options = array();
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
    public function getMerchandise()
    {
        return $this->merchandise;
    }

    /**
     * @inheritdoc
     */
    public function getOption($name)
    {

        if( array_key_exists($name, $this->options) )
        {

            return $this->options[$name];
        }

        return null;
    }
    
    /**
     * @inheritdoc
     */
    public function getOptions()
    {

        return $this->options;
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
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
    function setMerchandise($merchandise)
    {

        $this->merchandise = $merchandise;
    }

    /**
     * @inheritdoc
     */
    public function setOption($name, $value)
    {

        $this->options[$name] = $value;
    }

    /**
     * @inheritdoc
     */
    public function setQuantity($quantity)
    {

        $this->$quantity = $quantity;
    }
    
    /**
     * @inheritdoc
     */
    function setUpdatedAt(DateTime $updatedAt)
    {

        $this->updatedAt = $updatedAt;
    }
}