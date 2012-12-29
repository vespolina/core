<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\Entity\Product;

use Vespolina\Entity\Product\OptionGroupInterface;

/**
 * @author Richard D Shank <develop@zestic.com>
 */
class OptionGroup implements OptionGroupInterface
{
    protected $options;
    protected $name;
    protected $display;
    protected $required;

    public function __construct()
    {
        $this->options = array();
    }

    /*
     * @inheritdoc
     */
    public function addOption(OptionInterface $option)
    {
        $optionType = $option->getType();
        if (!$this->name && !$optionType) {
            throw new \UnexpectedValueException('The OptionGroup must have the name set or the Option must have the group type set');
        }
        if (!$optionType) {
            $option->setType($this->name);
        }
        if (!$this->name) {
            $this->name = $optionType;
        }
        if ($this->name != $option->getType()) {
            throw new \UnexpectedValueException(sprintf('All OptionsNodes in this type must be %s', $this->name));
        }
        $value = $option->getValue();
        $this->options[$value] = $option;
    }

    /*
     * @inheritdoc
     */
    public function addOptions(array $options)
    {
        foreach ($options as $option) {
            $this->addOption($option);
        }
    }

    /**
     * @inheritdoc
     */
    public function clearOptions()
    {
        $this->options = array();
    }

    /**
     * @inheritdoc
     */
    public function getOption($value)
    {
        return isset($this->options[$value]) ? $this->options[$value] : null;
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @inheritdoc
     */
    public function setOptions($options)
    {
        $this->clearOptions();
        foreach ($options as $option) {
            $this->addOption($option);
        }
    }

    /**
     * @inheritdoc
     */
    public function removeOption(OptionInterface $option)
    {
        $value = $option->getValue();
        if (isset($this->options[$value])) {
            unset($this->options[$value]);
        }
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    public function setDisplay($display)
    {
        $this->display = $display;
    }

    public function getDisplay()
    {
        return $this->display;
    }

    public function setRequired($required)
    {
        $this->required = $required;
    }

    public function getRequired()
    {
        return $this->required;
    }
}
