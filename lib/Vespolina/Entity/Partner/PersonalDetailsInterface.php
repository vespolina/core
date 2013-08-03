<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Partner;

interface PersonalDetailsInterface
{
    /**
     * Set initials of customer
     * @param string $initials
     * @return \Vespolina\Entity\Partner\PersonalDetailsInterface
     */
    function setInitials($initials);

    /**
     * Get initials of customer
     * @return string
     */
    function getInitials();

    /**
     * Set firstname of customer
     * @param string $firstname
     * @return \Vespolina\Entity\Partner\PersonalDetailsInterface
     */
    function setFirstname($firstname);

    /**
     * Get firstname of customer
     * @return string
     */
    function getFirstname();

    /**
     * Set prefix of customer
     * @param string $prefix
     * @return \Vespolina\Entity\Partner\PersonalDetailsInterface
     */
    function setPrefix($prefix);

    /**
     * Get prefix of customer
     * @return string
     */
    function getPrefix();

    /**
     * Set lastname of customer
     * @param string $lastname
     * @return \Vespolina\Entity\Partner\PersonalDetailsInterface
     */
    function setLastname($lastname);

    /**
     * Get lastname of customer
     * @return string
     */
    function getLastname();

    /**
     * Set national identification number
     * @param string $nationalIdentificationNumber
     * @return \Vespolina\Entity\Partner\PersonalDetailsInterface
     */
    function setNationalIdentificationNumber($nationalIdentificationNumber);

    /**
     * Get national identification number
     * @return string
     */
    function getNationalIdentificationNumber();
}