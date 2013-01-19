<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

use Vespolina\Entity\Identifier\IdentifierInterface;
use Vespolina\Entity\Product\BaseProduct;
use Vespolina\Entity\Product\OptionInterface;
use Vespolina\Entity\Product\OptionGroupInterface;
use Vespolina\Entity\Product\ProductInterface;

/**
 * @author Richard D Shank <develop@zestic.com>
 * @author Daniel Kucharski <daniel@xerias.be>
 */
class Product extends BaseProduct implements ProductInterface
{
    protected $slug;
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
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
    public function createProductIdentifierSet($options)
    {
        return new $this->identifierSetClass($options);
    }

    /**
     * @inheritdoc
     */
    public function getPrimaryIdentifierSet()
    {
        return $this->identifiers->get('primary');
    }

    /**
     * @inheritdoc
     */
    public function getOptionSet($target)
    {
        foreach ($this->identifiers as $optionSet) {
            if (!count(array_diff_assoc($optionSet->getOptions(), $target))) {
                return $optionSet;
            }
        }
        return null;
    }

    /*
     * @inheritdoc
     */
    public function processIdentifiers()
    {
        $optionSet = array();
        foreach ($this->options as $productOption) {
            $options = $productOption->getOptions();
            if ($options) {
                $choices = array();
                $name = $productOption->getName();
                foreach ($options as $option) {
                    $choices[] = array($name => $option->getValue());
                }
                $optionSet[$name] = $choices;
            }
        }

        ksort($optionSet);
        if ($optionCombos = $this->extractOptionCombos($optionSet)) {
            foreach ($optionCombos as $key => $combo) {
                if (!$this->identifiers->containsKey($key)) {
                    $this->identifiers->set($key, $this->createProductIdentifierSet($combo));
                }
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function validateOptions(array $options)
    {
        // todo: actually validate, for now return true, just to prevent breaking things
        return true;
    }

    protected function extractOptionCombos($optionSet)
    {
        if ($curSet = array_shift($optionSet)) {
            $combos = $this->extractOptionCombos($optionSet);
            $return = array();
            foreach ($curSet as $option) {
                $key = $this->createKeyFromOptions($option);
                if ($combos) {
                    foreach ($combos as $curKey => $curCombo) {
                        $returnKey = $key . $curKey;
                        $return[$returnKey] = array_merge($option, $curCombo);
                    }
                } else {
                    $return[$key] = $option;
                }
            }
            return $return;
        }
        return null;
    }

    protected function createKeyFromOptions($options)
    {
        $key = '';
        ksort($options);
        foreach ($options as $optionGroup => $option) {
            $key .= sprintf('%s:%s;', $optionGroup, $option);
        }
        return $key;
    }
}
