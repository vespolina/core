<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity;

use Vespolina\Entity\InvoiceInterface;
use Vespolina\Entity\OrderInterface;

/**
 * Invoice for an order
 *
 * @author Richard Shank <develop@zestic.com>
 */
class Invoice implements InvoiceInterface
{
    private $order;

    /**
     * @inherit
     */
    public function setOrder(OrderInterface $order)
    {
        $this->order = $order;
    }

    /**
     * @inherit
     */
    public function getOrder()
    {
        return $this->order;
    }
}
