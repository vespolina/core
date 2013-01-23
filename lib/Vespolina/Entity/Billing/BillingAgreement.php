<?php
namespace Vespolina\Entity\Billing;

use Vespolina\Entity\Order\OrderInterface;
use Vespolina\Entity\Partner\PartnerInterface;

class BillingAgreement implements BillingAgreementInterface
{
    protected $billingAmount;
    protected $billingCycles;
    protected $billingInterval;
    protected $initialBillingDate;
    protected $nextBillingDate;
    protected $order;
    protected $partner;
    protected $paymentGateway;
    protected $totalCycles;

    public function setBillingAmount($billingAmount)
    {
        $this->billingAmount = $billingAmount;

        return $this;
    }

    public function getBillingAmount()
    {
        return $this->billingAmount;
    }

    public function setBillingCycles($billingCycles)
    {
        $this->billingCycles = $billingCycles;

        return $this;
    }

    public function getBillingCycles()
    {
        return $this->billingCycles;
    }

    public function setBillingInterval($billingInterval)
    {
        $this->billingInterval = $billingInterval;

        return $this;
    }

    public function getBillingInterval()
    {
        return $this->billingInterval;
    }

    public function setInitialBillingDate(\DateTime $initialBillingDate)
    {
        $this->initialBillingDate = $initialBillingDate;

        return $this;
    }

    public function getInitialBillingDate()
    {
        return $this->initialBillingDate;
    }

    public function setNextBillingDate(\DateTime $nextBillingDate)
    {
        $this->nextBillingDate = $nextBillingDate;

        return $this;
    }

    public function getNextBillingDate()
    {
        return $this->nextBillingDate;
    }

    public function setOrder(OrderInterface $order)
    {
        $this->order = $order;

        return $this;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setPartner(PartnerInterface $partner)
    {
        $this->partner = $partner;

        return $this;
    }

    public function getPartner()
    {
        return $this->partner;
    }

    public function setPaymentGateway($paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;

        return $this;
    }

    public function getPaymentGateway()
    {
        return $this->paymentGateway;
    }

    public function setTotalCycles($totalCycles)
    {
        $this->totalCycles = $totalCycles;

        return $this;
    }

    public function getTotalCycles()
    {
        return $this->totalCycles;
    }
}
