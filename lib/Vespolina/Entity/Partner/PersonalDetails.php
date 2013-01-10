<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\Entity\Partner;

class PersonalDetails implements PersonalDetailsInterface
{
    protected $initials;
    protected $firstname;
    protected $prefix;
    protected $lastname;
    protected $nationalIdentificationNumber;
    protected $partner;
    
	/**
	 * {@inheritdoc}
	 */
    public function getInitials()
    {
        return $this->initials;
    }

	/**
	 * {@inheritdoc}
	 */
    public function setInitials($initials)
    {
        $this->initials = $initials;
    }

	/**
	 * {@inheritdoc}
	 */
    public function getFirstname()
    {
        return $this->firstname;
    }

	/**
	 * {@inheritdoc}
	 */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

	/**
	 * {@inheritdoc}
	 */
    public function getPrefix()
    {
        return $this->prefix;
    }

	/**
	 * {@inheritdoc}
	 */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

	/**
	 * {@inheritdoc}
	 */
    public function getLastname()
    {
        return $this->lastname;
    }

	/**
	 * {@inheritdoc}
	 */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

	/**
	 * {@inheritdoc}
	 */
    public function getNationalIdentificationNumber()
    {
       return $this->nationalIdentificationNumber;
    }

	/**
	 * {@inheritdoc}
	 */
    public function setNationalIdentificationNumber($nationalIdentificationNumber)
    {
        $this->nationalIdentificationNumber = $nationalIdentificationNumber;
    }
    
	/**
	 * {@inheritdoc}
	 */
    public function getPartner()
    {
        return $this->partner;
    }

	/**
	 * {@inheritdoc}
	 */
    public function setPartner(\Vespolina\PartnerBundle\Document\Partner $partner)
    {
        $partner->setPersonalDetails($this);
        $this->partner = $partner;
    }
}