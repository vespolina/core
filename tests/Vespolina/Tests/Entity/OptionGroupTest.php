<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Product\Option;
use Vespolina\Entity\Product\OptionGroup;

/**
 * @author Richard D Shank <richard@vespolina.org>
 */
class OptionGroupTest extends \PHPUnit_Framework_TestCase
{
    public function testAddOptions()
    {
        $colorRed = $this->createOption('Red', 'red', 'color', 'colorRed');

        $sizeXl = $this->createOption('Extra Large', 'XL', 'size', 'sizeXl');

        $og = new OptionGroup();

        // DO NOT SET THE NAME IN THE GROUP!
        $og->addOption($colorRed);

        $this->assertEquals(
            'color',
            $og->getType(),
            'if the type is not set, the name should be set to the type of the Option'
        );

        $this->assertSame(
            $colorRed,
            $og->getOption('colorRed'),
            'the option value should be found by its value'
        );

        $this->assertSame(
            $colorRed,
            $og->getOptionByDisplay('Red'),
            'the name of the option node should be set to the value'
        );

        $noTypeGreen = $this->createOption('Green', 'green', null, 'colorGreen');
        $og->addOption($noTypeGreen);

        $this->assertSame(
            $noTypeGreen,
            $og->getOption('colorGreen'),
            'if the type is not set, the option should be added to the group'
        );

        $this->assertSame(
            'color',
            $noTypeGreen->getType(),
            'if the type is not set, type option type should be set to the name of the group'
        );

        $this->setExpectedException('UnexpectedValueException', 'All OptionsNodes in this type must be color');
        $og->addOption($sizeXl);

        $noTypeBlue = $this->createOption('Blue', 'blue', null, 'colorBlue');
        $og = new OptionGroup();
        // DO NOT SET THE NAME IN THE GROUP!
        $this->setExpectedException('UnexpectedValueException', 'The OptionGroup must have the name set or the Option must have the group type set');
        $og->addOption($noTypeBlue);
    }

    public function testHandleOptions()
    {
        $og = new OptionGroup();
        $colorRed = $this->createOption('Red', 'red', 'color', 'colorRed');

        $og->addOption($colorRed);
        $this->assertCount(1, $og->getOptions());
        $this->assertSame($colorRed, $og->getOption('colorRed'));

        $og->clearOptions();
        $this->assertEmpty($og->getOptions());

        $colorBlue = $this->createOption('Blue', 'blue', 'color', 'colorBlue');
        $options = array($colorRed, $colorBlue);

        $og->setOptions($options);
        $this->assertCount(2, $og->getOptions());

        $og->removeOption($colorBlue);
        $this->assertCount(1, $og->getOptions());
        $this->assertNull($og->getOption('colorBlue'));

        $colorGreen = $this->createOption('Green', 'green', 'color', 'colorGreen');
        $options = array($colorGreen, $colorBlue);

        $og->addOptions($options);
        $this->assertCount(3, $og->getOptions());
    }

    public function testGetOptionsArray()
    {
        $colorGroup = new OptionGroup();
        $colorBlue = $this->createOption('Blue', 'blue', 'color', 'colorBlue');
        $colorGreen = $this->createOption('Green', 'green', 'color', 'colorGreen');
        $colorRed = $this->createOption('Red', 'red', 'color', 'colorRed');
        $colorGroup->addOption($colorBlue);
        $colorGroup->addOption($colorGreen);
        $colorGroup->addOption($colorRed);
        $expected = [
            'colorBlue' => 'Blue',
            'colorGreen' => 'Green',
            'colorRed' => 'Red',
        ];
        $this->assertEquals($expected, $colorGroup->getOptionsArray());
    }

    protected function createOption($display, $name, $type, $index)
    {
        $option = new Option();

        $option->setDisplay($display);
        $option->setIndex($index);
        $option->setName($name);
        $option->setType($type);

        return $option;
    }
}
