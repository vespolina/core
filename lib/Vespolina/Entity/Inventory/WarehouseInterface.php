<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Inventory;

use Vespolina\Entity\Partner\AddressInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
interface WarehouseInterface
{

    /**
     * Get the address (street, nr, ....) where the warehouse is located
     *
     * @abstract
     * @return Vespolina\Entity\Partner\AddressInterface
     */
    function getAddress();

    /**
     * Name of this warehouse
     *
     * @abstract
     * @return string
     */
    function getName();

    /**
     * @param AddressInterface $address
     * @return mixed
     */
    function setAddress(AddressInterface $address );

    function setName($name);


}