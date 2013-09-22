<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Inventory;

use Vespolina\Entity\Inventory\WarehouseInterface;

/**
 * @author Daniel Kucharski <daniel@vespolina.org>
 * @author Richard Shank <richard@vespolina.org>
 */
interface StorageLocationInterface
{

    /**
     * Get the unique address code which identifies this storage location
     *
     * @abstract
     * @return string
     */
    function getAddressCode();

    /**
     * Optionally the storage location's address also has a name such as "ground floor - left wing"
     *
     * @abstract
     * @return string
     */
    function getName();

    /**
     * Get the storage type (eg. picking area, goods receipt area, high rack area, ... )
     * @abstract
     * @return void
     */
    function getStorageType();

    /**
     * Return the warehouse where this storage location is located at
     *
     * @abstract
     * @return WarehouseInterface
     */
    function getWarehouse();



    function setName($name);

    /**
     * Specify the storage location type (eg. "goods receipt area", "storage", "picking area" )
     *
     * @abstract
     * @param $storageType
     * @return void
     */
    function setStorageType($storageType);

    function setWarehouse(WarehouseInterface $warehouse);
}