<?php
/**
 * (c) 2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Partner\Partner;
use Vespolina\Entity\Partner\Address;

class PartnerTest extends \PHPUnit_Framework_TestCase
{
    // todo: payment profile (cc profile)
    public function testPaymentProfileMethods()
    {
        $this->markTestIncomplete('tests for payment profiles (including cc) need to be written and implemented');
    }

    public function testFluentInterface()
    {
        $addressOnFile = new Address();
        $addressOnFile
            ->setZipcode('20201')
            ->setNumber(20209)
            ->setNumbersuffix('No.')
            ->setStreet('Main St.')
            ->setCity('Columbia')
            ->setState('SC')
            ->setCountry('US')
            ->setType('on file')
        ;

        $partner = new Partner();
        $partner
            ->setShortName('jake')
            ->setRoles(array('ROLE_USER'))
            ->setName('customer')
            ->setLanguage('English')
            ->setCurrency('USD')
            ->setType(Partner::INDIVIDUAL)
            ->setAddresses(array($addressOnFile))
        ;

        $this->assertContains('ROLE_USER', $partner->getRoles());
    }
}
