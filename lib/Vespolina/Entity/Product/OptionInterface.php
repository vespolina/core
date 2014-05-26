<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

/**
 * @author Richard D Shank <richard@vespolina.org>
 */
interface OptionInterface
{
    /**
     * Set the displayed name for this option.
     * ie, Red, Large
     *
     * @param string $display
     * @return $this
     */
    public function setDisplay($display);

    /**
     * Return the display name of the option
     *
     * @return string
     */
    public function getDisplay();

    /**
     * Set the assigned value for this option. May or not be descriptive, used for identifying
     * this option in a group.
     * ie, red, large, abcedf
     *
     * @param string $index
     * @return $this
     */
    public function setIndex($index);

    /**
     * Return the option value
     *
     * @return string
     */
    public function getIndex();

    /**
     * Set the name of this option. The name is generally shorter in length than the display.
     * ie, RD, L
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Return the name of this option.
     *
     * @return string
     */
    public function getName();

    /**
     * Set the group type of option. It corresponds with a type in an OptionGroup
     * ie color, size
     *
     * @param string $type
     * @return $this
     */
    public function setType($type);

    /**
     * Return the group type of option
     *
     * @return string
     */
    public function getType();
}
