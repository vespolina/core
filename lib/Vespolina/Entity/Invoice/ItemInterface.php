<?php
/**
 * (c) 2012-2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Invoice;

use Vespolina\Entity\Partner\PartnerInterface;
use Vespolina\Entity\Pricing\PricingSetInterface;
use Vespolina\Entity\Product\ProductInterface;

/**
 * An interface for an invoice item.
 *
 * It differs from an order item because an invoice item doesn't necessarily to be linked to an order(item)
 * nor does it needs to be linked to an actual product.
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
