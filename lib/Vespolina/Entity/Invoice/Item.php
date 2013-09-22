<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Invoice;

use Vespolina\Entity\Item as BaseItem;
use Vespolina\Entity\Order\ItemInterface as OrderItemInterface;

/**
 * Item is a class for items in an order
 *
 * @author Richard Shank <richard@vespolina.org>
 */
class Item extends BaseItem implements ItemInterface
{
    protected $description;
    protected $orderItem;

    /**
     * {@inheritdoc}
     */
    public function setOrderItem(OrderItemInterface $orderItem)
    {
        $this->orderItem = $orderItem;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrderItem()
    {
        return $this->orderItem;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}
