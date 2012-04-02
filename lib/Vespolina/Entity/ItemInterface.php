<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity;

use Vespolina\Entity\OrderInterface;

/**
 * ItemInterface is an interface for items in an order
 *
 * @author Richard Shank <develop@zestic.com>
 */
interface ItemInterface
{
    /**
     * Set the parent order for this item
     *
     * @param Vespolina\Entity\OrderInterface $parent
     */
    function setParent(OrderInterface $parent);

    /**
     * Return the order where this items belongs
     *
     * @return Vespolina\Entity\OrderInterface
     */
    function getParent();

}
