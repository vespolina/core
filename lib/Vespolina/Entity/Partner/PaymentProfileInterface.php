<?php

namespace Vespolina\Entity\Partner;

use Vespolina\Entity\Partner\PartnerInterface;

interface PaymentProfileInterface
{
    function setPartner(PartnerInterface $partner);

    function getPartner();

    function getId();

    function setReference($reference);

    function getReference();
}
