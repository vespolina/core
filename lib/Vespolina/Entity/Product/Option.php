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
 * @author Richard D Shank <develop@zestic.com>
 */
class Option implements OptionInterface
{
    protected $display;
    protected $type;
    protected $value;
    protected $upcharge;

    /*
     * @inheritdoc
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
    /*
     * @inheritdoc
     */
    public function getValue()
    {
        return $this->value;
    }

    /*
     * @inheritdoc
     */
    public function setDisplay($display)
    {
        $this->display = $display;
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
    public function setType($type)
    {
        $this->type = $type;
    }

    /*
     * @inheritdoc
     */
    public function getType()
    {
        return $this->type;
    }

    /*
     * @inheritdoc
     */
    public function setUpcharge($upcharge)
    {
        $this->upcharge = $upcharge;
    }

    /*
     * @inheritdoc
     */
    public function getUpcharge()
    {
        return $this->upcharge;
    }
}
