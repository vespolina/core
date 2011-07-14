<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Model;

use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Model\CartItemInterface;
 
/**
 * CartItem implements a basic cart item implementation
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 */
class CartItem implements CartItemInterface
{
    protected $cart;
    protected $merchandise;
    protected $merchandiseOptions;
    protected $quantity;
    protected $status;

    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
        $this->merchandiseOptions = array();
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
    public function getMerchandiseOption($name)
    {

        if (array_key_exists($name, $this->merchandiseOptions))
        {

            return $this->merchandiseOptions[$name];
        }
    }

    /**
     * @inheritdoc
     */
    public function getMerchandiseOptions()
    {

        return $this->merchandiseOptions;
    }

    /**
     * @inheritdoc
     */
    public function getStatus()
    {

        return $this->status;
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
    public function setMerchandise($merchandise)
    {

        $this->merchandise = $merchandise;
    }

    /**
     * @inheritdoc
     */
    public function setMerchandiseOption($name, $value)
    {

        $this->merchandiseOptions[$name] = $value;
    }

    /**
     * @inheritdoc
     */
    public function setQuantity($quantity)
    {

        $this->quantity = $quantity;
    }

    /**
     * @inheritdoc
     */
    public function setStatus($status)
    {

        $this->status = $status;
    }

}