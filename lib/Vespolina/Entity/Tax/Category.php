<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Tax;

use Vespolina\Entity\Tax\CategoryInterface;

/**
 * TaxCategory holds the basic tax classification for various entities such as
 *
 *  - defining the customer tax category.  eg. "wholesale customer"
 *  - defining the product tax category eg. "food", "luxary good"
 *
 * @author Daniel Kucharski <daniel@vespolina.org>
 */
class Category implements CategoryInterface
{
    protected $code;
    protected $name;

    /**
     * @inheritdoc
     */
    public function getCode()
    {

        return $this->code;
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
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
