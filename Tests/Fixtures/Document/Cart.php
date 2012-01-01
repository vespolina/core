<?php
/**
 * (c) 2011 - 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Tests\Fixtures\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

use Vespolina\CartBundle\Document\BaseCart;
use Vespolina\CartBundle\Model\CartableItemInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */
/**
 * @ODM\Document(collection="vespolina_cart")
 */
class Cart extends BaseCart
{
    /** @ODM\Id */
    protected $id;

    /** @ODM\String */
    protected $name;

    /** @ODM\EmbedMany(targetDocument="Vespolina\CartBundle\Tests\Fixtures\Document\CartItem", strategy="set") */
    protected $items;

    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function getId()
    {
        return $this->id;
    }
}
