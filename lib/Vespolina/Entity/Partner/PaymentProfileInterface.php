<?php

namespace Vespolina\Entity\Partner;

use Vespolina\Entity\Partner\PartnerInterface;

interface PaymentProfileInterface
{
    function setPartner(PartnerInterface $partner);

    /** @return PartnerInterface */
    function getPartner();

    function getId();

    function setReference($reference);

    function getReference();

    function setBillingAddress($billingAddress);

    function getBillingAddress();

    function setBillingZipCode($billingZipCode);

    function getBillingZipCode();

    function setBillingCity($billingCity);

    function getBillingCity();

    function setBillingCountry($billingCountry);

    function getBillingCountry();

    function setBillingPhone($billingPhone);

    function getBillingPhone();

    function setBillingState($billingState);

    function getBillingState();

    function isSetup();

    function getType();
}
