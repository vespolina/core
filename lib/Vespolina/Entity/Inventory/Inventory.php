<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Inventory;


use Vespolina\Entity\Inventory\InventoryInterface;
use Vespolina\Entity\Identifier\IdentifierInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
abstract class Inventory implements InventoryInterface
{
    protected $available;
    protected $createdAt;
    protected $detailedCount;
    protected $identifier;
    protected $onHand;
    protected $optionSet;
    protected $product;
    protected $updatedAt;

    public function __construct($product, $optionSet = null)
    {
        $this->product = $product;
        $this->optionSet = $optionSet;
    }

    /**
     * @inheritdoc
     */
    function getDetailedCount($granularity)
    {

        return $this->detailedCount;
    }

    /**
     * @inheritdoc
     */
    function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @inheritdoc
     */
    function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @inheritdoc
     */
    function setIdentifier(IdentifierInterface $identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * @inheritdoc
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * @inheritdoc
     */
    public function getOnHand()
    {
        return $this->onHand;
    }

    /**
     * @inheritdoc
     */
    public function getOptionSet()
    {
        return $this->optionSet;
    }
}