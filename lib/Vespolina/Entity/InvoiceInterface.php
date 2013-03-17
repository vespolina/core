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
 * An interface for an invoice for an order
 *
 * @author Richard Shank <develop@zestic.com>
 */
interface InvoiceInterface
{
    /**
     * Set the order for this invoice
     *
     * @param \Vespolina\Entity\OrderInterface $order
     * @return \Vespolina\Entity\InvoiceInterface
     */
    function setOrder(OrderInterface $order);

    /**
     * Return the order for this invoice
     *
     * @return \Vespolina\Entity\OrderInterface
     */
    function getOrder();
}
