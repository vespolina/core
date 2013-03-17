<?php

namespace Vespolina\Entity\Payment;

interface PaymentProfileInterface
{
    function getId();

    function setReference($reference);

    function getReference();
}
