<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Invoice;

use Vespolina\Entity\ItemInterface as BaseItemInterface;
use Vespolina\Entity\Order\ItemInterface as OrderItemInterface;


/**
 * An interface for an invoice item.
 *
 * It differs from an order item because an invoice item is not necessarily linked to an order(item)
 * or perhaps to an actual product.
 *
 * @author Daniel Kucharski <daniel@vespolina.org>
 */
interface ItemInterface extends BaseItemInterface
{
    function getDescription();

    function setDescription($description);

    function getOrderItem();

    /**
     * Set the order item this invoice item is referencing
     * @param OrderItemInterface $orderItem
     * @return mixed
     */
    function setOrderItem(OrderItemInterface $orderItem);
}
