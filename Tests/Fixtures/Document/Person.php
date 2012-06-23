<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Tests\Fixtures\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */

/**
 * @ODM\Document(collection="test_person")
 */
class Person implements UserInterface
{
    /** @ODM\Id */
    protected $id;

    /** @ODM\String */
    protected $username;

    public function getId()
    {
        return $this->id;
    }

    public function __construct($username = null)
    {
        $this->username = $username;
    }

    public function getRoles()
    {

    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {

    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string The salt
     */
    public function getSalt()
    {

    }

    public function setUserName($username)
    {
        $this->username = $username;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     *
     * @return void
     */
    public function eraseCredentials()
    {

    }
}
