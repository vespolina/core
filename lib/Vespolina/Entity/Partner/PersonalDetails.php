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
    protected $id;
    protected $initials;
    protected $firstname;
    protected $prefix;
    protected $lastname;
    protected $nationalIdentificationNumber;

    public function getId()
    {
        return $this->id;
    }

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

        return $this;
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

        return $this;
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

        return $this;
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

        return $this;
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

        return $this;
    }
}