<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Model\Option;

use Vespolina\CartBundle\Model\CartItemInterface;
use Vespolina\CartBundle\Model\Option\OptionInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard D Shank <develop@zestic.com>
 */
abstract class Option implements OptionInterface
{

    protected $cartItem;
    protected $type;
    protected $value;

    /*
     * @inheritdoc
     */
    public function setCartItem(CartItemInterface $cartItem)
    {
        $this->cartItem = $cartItem;
    }

    /*
     * @inheritdoc
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /*
     * @inheritdoc
     */
    public function getValue()
    {
        return $this->value;
    }


    /*
     * @inheritdoc
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /*
     * @inheritdoc
     */
    public function getType()
    {
        return $this->type;
    }
    

}
