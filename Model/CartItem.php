<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Model;

use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Model\CartItemInterface;

class CartItem implements CartItemInterface
{
    protected $cart;
    protected $status;

    public function __construct(CartInterface $cart)
    {
        $this->attributes = array();
        $this->cart = $cart;
    }

    /**
     * @inheritdoc
     */
    public function getAttribute($name)
    {

        if( array_key_exists($name, $this->attributes) )
        {

            return $this->attributes[$name];
        }

        return null;
    }


    /**
     * @inheritdoc
     */
    public function getAttributes()
    {

        return $this->attributes;
    }


    /**
     * @inheritdoc
     */
    public function setAttribute($name, $value)
    {

        $this->attributes[$name] = $value;
    }

}