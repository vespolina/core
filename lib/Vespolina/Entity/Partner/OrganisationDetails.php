<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Partner;

class OrganisationDetails implements OrganisationDetailsInterface
{
    protected $category;
    protected $employees;
    protected $id;
    protected $name;

    public function getId()
    {
        return $this->id;
    }

	/**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

	/**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

	/**
     * {@inheritdoc}
     */
    public function getCategory()
    {
        return $this->category;
    }

	/**
     * {@inheritdoc}
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

	/**
     * {@inheritdoc}
     */
    public function getEmployees()
    {
        return $this->employees;
    }

	/**
     * {@inheritdoc}
     */
    public function setEmployees($employees)
    {
        $this->employees = $employees;

        return $this;
    }
}