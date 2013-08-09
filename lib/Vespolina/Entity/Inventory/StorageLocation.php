<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Inventory;

use Vespolina\Entity\Inventory\StorageLocationInterface;
use Vespolina\Entity\Inventory\WarehouseInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
abstract class StorageLocation implements StorageLocationInterface
{

    protected $addressCode;
    protected $name;
    protected $storageType;
    protected $updatedAt;
    protected $warehouse;



    /**
     * @inheritdoc
     */
    function getAddressCode()
    {

        return $this->addressCode;
    }


    /**
     * @inheritdoc
     */
    function getName()
    {

        return $this->name;
    }


    /**
     * @inheritdoc
     */
    function getStorageType()
    {

        return $this->storageType;
    }

    /**
     * @inheritdoc
     */
    function getWarehouse()
    {

        return $this->warehouse;
    }

    /**
     * @inheritdoc
     */
    function setAddressCode($addressCode)
    {

        $this->addressCode = $addressCode;
    }

    /**
     * @inheritdoc
     */
    function setName($name)
    {

        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    function setStorageType($storageType)
    {

        $this->storageType = $storageType;
    }

    /**
     * @inheritdoc
     */
    function setWarehouse(WarehouseInterface $warehouse)
    {

        $this->warehouse = $warehouse;
    }

}