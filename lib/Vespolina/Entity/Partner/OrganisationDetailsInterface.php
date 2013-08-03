<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Partner;

interface OrganisationDetailsInterface
{
    /**
     * Set the organisation name
     * 
     * @param string $name
     * @return \Vespolina\Entity\Partner\OrganisationDetailsInterface
     */
    function setName($name);
    
    /**
     * Returns the organisation name
     * @return string
     */
    function getName();
    
    /**
     * Set the category (e.g. Education, Government, Insurance etc) 
     * @param string $category
     * @return \Vespolina\Entity\Partner\OrganisationDetailsInterface
     */
    function setCategory($category);
    
    /**
     * Returns the organistaion category
     * @return string
     */
    function getCategory();
    
    /**
     * Set the number employees (e.g. 25-50)
     * @param string $employees
     * @return \Vespolina\Entity\Partner\OrganisationDetailsInterface
     */
    function setEmployees($employees);
    
    /**
     * Returns the number of employees
     * @return string
     */
    function getEmployees();
}