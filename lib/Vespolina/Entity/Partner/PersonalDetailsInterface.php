<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
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
     */
    function setNationalIdentificationNumber($nationalIdentificationNumber);

    /**
     * Get national identification number
     * @return string
     */
    function getNationalIdentificationNumber();
}