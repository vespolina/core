<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

use Vespolina\Entity\Product\AttributeInterface;

/**
 * @author Richard D Shank <develop@zestic.com>
 */
class Attribute implements AttributeInterface
{
    protected $name;
    protected $searchTerm;
    protected $type;

    /**
     * @inheritdoc
     */
    public function setSearchTerm($searchTerm)
    {
        $this->searchTerm = strtolower($searchTerm);
    }

    /**
     * @inheritdoc
     */
    public function getSearchTerm()
    {
        return $this->searchTerm;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;
        if (!$this->searchTerm) {
            $this->setSearchTerm($name);
        }
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
    public function setType($type)
    {
        $this->type = strtolower($type);
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this->type;
    }
}
