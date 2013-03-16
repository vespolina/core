<?php
/**
 * (c) 2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Partner\Address;
use Vespolina\Entity\Partner\Partner;
use Vespolina\Entity\Partner\PaymentProfile;

class PartnerTest extends \PHPUnit_Framework_TestCase
{
    public function testPaymentProfileMethods()
    {
        $partner = new Partner();
        $this->assertEmpty($partner->getPaymentProfiles(), 'make sure we start out empty');

        $paymentProfile = new PaymentProfile();
        $paymentProfile->setReference('ref');
        $partner->addPaymentProfile($paymentProfile);
        $this->assertContains($paymentProfile, $partner->getPaymentProfiles());
        $this->assertCount(1, $partner->getPaymentProfiles());
        $this->assertSame($partner, $paymentProfile->getPartner(), 'the partner should be set in the paymentProfile');

        $paymentProfiles = array();
        $paymentProfiles[] = new PaymentProfile();
        $paymentProfiles[] = new PaymentProfile();

        $partner->addPaymentProfile($paymentProfile);
        $partner->setPaymentProfiles($paymentProfiles);
        $this->assertNotContains($paymentProfile, $partner->getPaymentProfiles(), 'this should have been removed on setting a new array of paymentProfiles');
        $this->assertCount(2, $partner->getPaymentProfiles());

        $partner->removePaymentProfile($paymentProfile);
        $this->assertNotContains($paymentProfile, $partner->getPaymentProfiles());
        $this->assertCount(2, $partner->getPaymentProfiles());

        $partner->clearPaymentProfiles();
        $this->assertEmpty($partner->getPaymentProfiles());
    }

    public function testSetPreferredPaymentProfile()
    {
        $partner = new Partner();

        $paymentProfile = new PaymentProfile();
        $paymentProfile->setReference('profile1');
        $partner->setPreferredPaymentProfile($paymentProfile);

        $this->assertSame($paymentProfile, $partner->getPreferredPaymentProfile());
        $this->assertContains($paymentProfile, $partner->getPaymentProfiles(), 'a profile should have been added to the collection of profiles');

        $paymentProfile2 = new PaymentProfile();
        $paymentProfile2->setReference('profile2');
        $partner->addPaymentProfile($paymentProfile2);
        $this->assertCount(2, $partner->getPaymentProfiles());

        $partner->setPreferredPaymentProfile($paymentProfile2);
        $this->assertSame($paymentProfile2, $partner->getPreferredPaymentProfile());
        $this->assertCount(2, $partner->getPaymentProfiles());
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
