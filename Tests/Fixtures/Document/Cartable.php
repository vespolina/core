<?php
/**
 * (c) 2011 - 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Tests\Fixtures\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

use Vespolina\CartBundle\Model\CartableItemInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
/**
 * @ODM\Document(collection="vespolina_cartable")
 */
class Cartable implements CartableItemInterface
{


    /** @ODM\Id */
    protected $id;

    /** @ODM\String */
    protected $name;

    protected $pricing;

    protected $optionSet;

    protected $type;

    public function __construct()
   {
       $this->prices = array();
   }


    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPricing($pricing)
    {
        $this->pricing = $pricing;
    }

    public function getPricing()
    {

        return $this->pricing;
    }

    public function getCartableName()
    {
        return $this->name;
    }

    public function getOptionSet()
    {
        return $this->optionSet;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }
}
