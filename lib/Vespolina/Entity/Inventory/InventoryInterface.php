<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Inventory;

/**
 * Interface defining a sales channel
 * (eg. web channel, point of sales channel, ..)
 */
use Vespolina\Entity\Identifier\IdentifierInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
interface InventoryInterface
{
    /**
     * Retrieve a detailed count per storage location for the given inventory set
     *
     * @abstract
     * @granularity Level of granularity (eg. 1 = warehouse level, 2 = storage location level )
     * @return Collection (eg.  [storage_location_A] -> 2, [storage_location_B2 -> 4] )
     */
    function getDetailedCount($granularity);

    /**
     * An inventory object should at least have an unique ID (eg. SKU)
     *
     * @abstract
     * @return IdentifierInterface
     */
    function getIdentifier();

    /**
     * When was this inventory statistic lastly updated
     * (eg. this could a full day if inventory data comes from an external party )
     *
     * @abstract
     * @return void
     */
    function getUpdatedAt();

    function setIdentifier(IdentifierInterface $identifier);

    /**
     * Return the number of items that are available to sell. Affected by reserved items and items sold.
     *
     * @return integer
     */
    function getAvailable();

    /**
     * Return the number of items in inventory. It is the actual physical count of the item,
     * regardless of items sold or reserved for a sale.
     *
     * @return integer
     */
    function getOnHand();
}