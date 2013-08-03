<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Invoice;

use Vespolina\Entity\Invoice\ItemInterface;
use Vespolina\Entity\Invoice\InvoiceInterface;
use Vespolina\Entity\Pricing\PricingSetInterface;

/**
 * Item is a class for items in an order
 *
 * @author Richard Shank <develop@zestic.com>
 */
class Item implements ItemInterface
{
    protected $id;
    protected $description;
    protected $name;
    protected $parent;
    protected $pricingSet;
    protected $quantity;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @inheritdoc
     */
    public function setParent(InvoiceInterface $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPricing()
    {
        return $this->pricingSet;
    }

    /**
     * @inheritdoc
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}
