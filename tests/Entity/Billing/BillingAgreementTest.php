<?php
/**
 * (c) 2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Vespolina\Entity\Billing\BillingAgreement;

class BillingAgreementTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $billingAgreement = new BillingAgreement();
        $this->assertTrue($billingAgreement->getActive());
        $this->assertEquals(0, $billingAgreement->getNumberCyclesBilled());


    }
}
