<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

use Vespolina\Entity\Identifier\IdentifierInterface;
use Vespolina\Entity\Product\BaseProduct;
use Vespolina\Entity\Product\OptionInterface;
use Vespolina\Entity\Product\ProductInterface;

/**
 * @author Richard D Shank <richard@vespolina.org>
 * @author Daniel Kucharski <daniel@vespolina.org>
 */
class Product extends BaseProduct implements ProductInterface
{
    protected $slug;

    public function equals(ProductInterface $product)
    {
        return ($this->id == $product->getId());
    }

    /**
     * @param OptionInterface $option
     * @return $this
     */
    public function setOption($type, $index, $display = null, $name = null)
    {
        $option = new Option();
        $option->setType($type);
        $option->setIndex($index);
        if ($display === null) {
            $display = $index;
        }
        $option->setDisplay($display);
        if ($name === null) {
            $name = $display;
        }
        $option->setName($name);

        $optionGroup = null;
        /** @var OptionGroup $curGroup */
        foreach ($this->optionGroups as $curGroup) {
            if ($curGroup->getType() == $type) {
                $optionGroup = $curGroup;
            }
        }
        if (!$optionGroup) {
            $optionGroup = new OptionGroup();
            $optionGroup->setType($type);
            $this->optionGroups[] = $optionGroup;
        }
        $optionGroup->addOption($option);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @inheritdoc
     */
    public function validateOptions(array $options)
    {
        // todo: actually validate, for now return true, just to prevent breaking things
        return true;
    }
}
