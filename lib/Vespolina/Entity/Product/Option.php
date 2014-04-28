<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Product;

use Vespolina\Entity\Product\OptionInterface;

/**
 * @author Richard D Shank <richard@vespolina.org>
 */
class Option implements OptionInterface
{
    protected $display;
    protected $index;
    protected $name;
    protected $type;

    /*
     * @inheritdoc
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }

    /*
     * @inheritdoc
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /*
     * @inheritdoc
     */
    public function setIndex($index)
    {
        $this->index = $index;

        return $this;
    }
    /*
     * @inheritdoc
     */
    public function getIndex()
    {
        return $this->index;
    }

    /*
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /*
     * @inheritdoc
     */
    public function getName()
    {
        return $this;
    }

    /*
     * @inheritdoc
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /*
     * @inheritdoc
     */
    public function getType()
    {
        return $this->type;
    }
}
