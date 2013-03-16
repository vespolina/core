<?php

namespace Vespolina\Entity\Partner;

use Vespolina\Entity\Partner\PartnerInterface;

interface PaymentProfileInterface
{
    function getId();

    function setPartner(PartnerInterface $partner);

    function getPartner();

    function setReference($reference);

    function getReference();
}
