<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Model;


class Cart implements CartInterface
{
    protected $items;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = array();
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
    public function getItems()
    {
        return $this->items;
    }

}