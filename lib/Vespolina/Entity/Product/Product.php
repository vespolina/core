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

    public function getOption($type, $index)
    {
        $options = $this->getOptions($type);
        /** @var Option $option */
        foreach ($options as $option) {
            if ($option->getIndex() == $index) {
                return $option;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setOption($type, $index, $display = null, $name = null)
    {
        if ($parent = $this->getParent()) {
            return $this->setVariationOption($parent, $type, $index, $display, $name);
        }
        if (!$option = $this->getOption($type, $index)) {
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
        } else {
            if ($display !== null) {
                $option->setDisplay($display);
            }

            if ($name !== null) {
                $option->setName($name);
            }
        }
        $this->addOptionToGroup($option);

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

    protected function addOptionToGroup(OptionInterface $option)
    {
        $type = $option->getType();
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
    }

    protected function setVariationOption($parent, $type, $index, $display = null, $name = null)
    {
        if ($option = $parent->getOption($type, $index)) {
            if ($display) {
                $option->setDisplay($display);
            }
            if ($name) {
                $option->setName($name);
            }
        } else {
            $parent->setOption($type, $index, $display, $name);
            $option = $parent->getOption($type, $index);
        }

        $this->addOptionToGroup($option);

        return $this;
    }
}
