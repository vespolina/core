<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Invoice;

/**
 * An interface for an invoice item.
 *
 * It differs from an order item because an invoice item is not necessarily linked to an order(item)
 * or to an actual product.
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 */
interface ItemInterface
{
    function getDescription();

    function setDescription($description);

    function getQuantity();

    function getPricing();
}
