<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Tax;

use Vespolina\Entity\Tax\CategoryInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
class Rate implements RateInterface
{
    protected $category;
    protected $code;
    protected $name;
    protected $rate;

    public function getCategory()
    {

        return $this->category;
    }
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
    public function getRate()
    {

        return $this->rate;
    }

    /**
     * @inheritdoc
     */
    public function setCategory(CategoryInterface $category)
    {
        $this->category = $category;
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

    /**
     * @inheritdoc
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }
}
