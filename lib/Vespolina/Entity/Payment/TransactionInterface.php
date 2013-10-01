<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Payment;

/**
 * TransactionInterface
 *
 * Transactions create a record that there has been a financial transaction between the shop and PaymentProfile. This
 * will typically happen through a PaymentHandler communicating with a gateway
 *
 * @package Vespolina\Entity\Payment
 */
interface TransactionInterface
{
    /**
     * Return the system id for this persisted data
     *
     * @return mixed
     */
    function getId();

    /**
     * Set the amount payed through the PaymentProfile to the shop during the payment transaction
     *
     * @param $credit
     * @return $this
     */
    function setCredit($credit);

    /**
     * Return the amount credited to the shop from the PaymentProfile during the payment transaction
     *
     * @return mixed
     */
    function getCredit();

    /**
     * Set the amount refunded to the PaymentProfile from the shop during the payment transaction
     *
     * @param mixed $debit
     * @return $this
     */
    function setDebit($debit);

    /**
     * Return the amount refunded to the PaymentProfile from the shop during the payment transaction
     *
     * @return mixed
     */
    function getDebit();

    /**
     * Set the PaymentProfile for this transaction
     * 
     * @param \Vespolina\Entity\Payment\PaymentProfileInterface $paymentProfile
     * @return $this
     */
    function setPaymentProfile(PaymentProfileInterface $paymentProfile);

    /**
     * Return the PaymentProfile for this transaction
     * 
     * @return \Vespolina\Entity\Payment\PaymentProfileInterface
     */
    function getPaymentProfile();

    /**
     * Set the time this transaction was posted
     * 
     * @param \DateTime $posted
     * @return $this
     */
    function setPosted(\DateTime $posted);

    /**
     * Return the time this transaction was posted
     * 
     * @return \DateTime
     */
    function getPosted();
}
