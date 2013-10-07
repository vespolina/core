<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Billing;

use Vespolina\Entity\Billing\BillingRequestInterface;
use Vespolina\Entity\Partner\PartnerInterface;
use Vespolina\Entity\Payment\PaymentProfileInterface;
use Vespolina\Entity\Payment\PaymentRequest;

class BillingRequest extends PaymentRequest implements BillingRequestInterface
{
    /**
     * A typical billing request flow will be:
     *  1) initial state
     *  2) pending: billing request is ready to be executed when the time has come
     *  3) paid: the payment was succesfull
     *  4) closed: post processing have been executed (eg. notifications)
     *
     *  After (2) it's possible that a clerk blocks the billing request temporarily or
     * cancels the billing request.
     *
     */

    const STATE_INITIAL = 'initial';        //Initial, just created
    const STATE_PENDING = 'pending';        //Ready to be billed
    const STATE_BLOCKED = 'blocked';        //Blocked by administration
    const STATE_CANCELLED = 'cancelled';    //Cancelled by administration
    const STATE_PAID = 'paid';              //Cancelled by administration
    const STATE_CLOSED = 'closed';          //(optional) processing after payment received was completed

    protected $consumption;
    protected $createdAt;
    protected $billingAgreements;
    protected $billingDate;
    protected $id;
    protected $plannedBillingDate;
    protected $customer;
    protected $paymentProfile;
    protected $periodStart;
    protected $periodEnd;
    protected $pricingSet;
    protected $state;

    public function __construct()
    {
        $this->billingAgreements = array();
        $this->consumption = array();
    }

    public function getId()
    {
        return $this->id;
    }

    public function addBillingAgreement(BillingAgreementInterface $billingAgreement)
    {
        $this->billingAgreements[] = $billingAgreement;

        return $this;
    }

    public function getBillingAgreements()
    {
        return $this->billingAgreements;
    }

    public function setPlannedBillingDate(\DateTime $date)
    {
        $this->plannedBillingDate = $date;

        return $this;
    }

    public function getBillingDate()
    {
        return $this->billingDate;
    }

    public function setBillingDate(\DateTime $date)
    {
        $this->billingDate = $date;

        return $this;
    }
    
    public function addConsumption($key, $value)
    {
        $this->consumption[$key] = $value;
       
        return $this;
    }
    public function getConsumption()
    {
        return $this->consumption;
    }

    public function setConsumption(array $consumption)
    {
        $this->consumption = $consumption;
	
        return $this;
    }

    public function getPlannedBillingDate()
    {
        return $this->plannedBillingDate;
    }

    public function isBlocked()
    {
        return $this->state == self::STATE_BLOCKED;
    }

    /**
     * @param \DateTime $date
     * @return $this
     */
    public function setCreatedAt(\DateTime $date)
    {
        $this->createdAt = $date;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param PartnerInterface $customer
     * @return PartnerInterface
     */
    public function setCustomer(PartnerInterface $customer)
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setPaymentProfile(PaymentProfileInterface $paymentProfile)
    {
        $this->paymentProfile = $paymentProfile;

        return $this;
    }

    public function getPaymentProfile()
    {
        return $this->paymentProfile;
    }


    public function setPeriodEnd(\DateTime $periodEnd)
    {
        $this->periodEnd = $periodEnd;

        return $this;
    }

    public function getPeriodEnd()
    {
        return $this->periodEnd;
    }

    public function setPeriodStart(\DateTime $periodStart)
    {
        $this->periodStart = $periodStart;

        return $this;
    }

    public function getPeriodStart()
    {
        return $this->periodStart;
    }

    public function setPricingSet($pricingSet)
    {
        $this->pricingSet = $pricingSet;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPricingSet()
    {
        return $this->pricingSet;
    }

    /**
     * @param string $state
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    public function autoSetCreatedAt()
    {
        if (null === $this->createdAt) {
            $this->createdAt = new \DateTime();
        }
        $this->autoSetUpdatedAt();

        return $this;
    }

    public function autoSetUpdatedAt()
    {
        $this->updatedAt = new \DateTime();

        return $this;
    }

}
