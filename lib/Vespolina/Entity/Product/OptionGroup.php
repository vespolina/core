<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

use Vespolina\Entity\Product\OptionGroupInterface;

/**
 * @author Richard D Shank <richard@vespolina.org>
 */
class OptionGroup implements OptionGroupInterface
{
    protected $display;
    protected $options;
    protected $required;
    protected $type;

    public function __construct()
    {
        $this->options = array();
    }

    /**
     * {@inheritdoc}
     */
    public function setDisplay($display)
    {
        $this->display = $display;
    }

    /**
     * {@inheritdoc}
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * {@inheritdoc}
     */
    public function addOption(OptionInterface $option)
    {
        $optionType = $option->getType();
        if (!$this->type && !$optionType) {
            throw new \UnexpectedValueException('The OptionGroup must have the type set or the Option must have the group type set');
        }
        if (!$optionType) {
            $option->setType($this->type);
        }
        if (!$this->type) {
            $this->type = $optionType;
        }
        if ($this->type != $option->getType()) {
            throw new \UnexpectedValueException(sprintf('All OptionsNodes in this type must be %s', $this->type));
        }
        $index = $option->getIndex();
        $this->options[$index] = $option;
    }

    /**
     * {@inheritdoc}
     */
    public function addOptions(array $options)
    {
        foreach ($options as $option) {
            $this->addOption($option);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearOptions()
    {
        $this->options = array();
    }

    /**
     * {@inheritdoc}
     */
    public function getOption($index)
    {
        return isset($this->options[$index]) ? $this->options[$index] : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptionByDisplay($display)
    {
        foreach ($this->options as $option) {
            if ($display == $option->getDisplay()) {
                return $option;
            }
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function setOptions($options)
    {
        $this->clearOptions();
        foreach ($options as $option) {
            $this->addOption($option);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeOption(OptionInterface $option)
    {
        $index = $option->getIndex();
        if (isset($this->options[$index])) {
            unset($this->options[$index]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setRequired($required)
    {
        $this->required = $required;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }
}
