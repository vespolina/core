<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Payment;

class Transaction implements TransactionInterface
{
    protected $credit;
    protected $debit;
    protected $id;
    protected $paymentProfile;
    protected $paymentRequest;
    protected $posted;

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * @inheritdoc
     */
    public function setDebit($debit)
    {
        $this->debit = $debit;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDebit()
    {
        return $this->debit;
    }

    /**
     * @inheritdoc
     */
    public function setPaymentProfile(PaymentProfileInterface $paymentProfile)
    {
        $this->paymentProfile = $paymentProfile;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPaymentProfile()
    {
        return $this->paymentProfile;
    }

    /**
     * Set the paymentRequest
     *
     * @param mixed $paymentRequest
     * @return $this
     */
    public function setPaymentRequest($paymentRequest)
    {
        $this->paymentRequest = $paymentRequest;
        return $this;
    }

    /**
     * Return the paymentRequest
     *
     * @return mixed
     */
    public function getPaymentRequest()
    {
        return $this->paymentRequest;
    }

    /**
     * @inheritdoc
     */
    public function setPosted(\DateTime $posted)
    {
        $this->posted = $posted;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPosted()
    {
        return $this->posted;
    }
}
