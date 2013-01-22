<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Pricing\Entity;

/**
 * PricingContext implements a data container holding price variables needed for calculation
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 */

use Vespolina\Entity\Pricing\PricingContextInterface;

class PricingContext implements PricingContextInterface
{
    protected $data;
    protected $entities;
 
    public function __construct($data = array())
    {
        $this->data = $data;
        $this->entities = array();

        if ($this->getQuantity() === null) {
            $this->setQuantity(1);
        }
    }

    public function addEntity($entity)
    {
        $this->entities[] = $entity;
    }

    public function getEntities()
    {
        return $this->entities;
    }

    public function setEntities($entities)
    {
        $this->entities = $entities;
    }

    public function get($key, $default = null)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        } elseif ($default) {
            return $default;
        } else {
            return null;
        }
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getQuantity()
    {
        return $this->get('quantity');
    }

    public function setQuantity($quantity)
    {
        $this->set('quantity', $quantity);
    }
}