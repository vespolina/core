<?php
/**
 * (c) 2011 - 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Tests\Fixtures\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

use Vespolina\CartBundle\Document\BaseProduct;
use Vespolina\CartBundle\Model\CartableItemInterface;

/**
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
}
