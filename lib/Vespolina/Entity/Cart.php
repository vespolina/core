<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\Entity\Model;

use Vespolina\Entity\BaseOrder;
/**
 * Cart implements a basic cart implementation
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
class Cart extends BaseOrder implements CartInterface
{
    const STATE_OPEN = 'open';          //Available for change
    const STATE_LOCKED = 'locked';      //Locked for processing
    const STATE_CLOSED = 'closed';      //Closed after processing
    const STATE_EXPIRED = 'expired';    //Unprocessed and expired

    protected $attributes;
    protected $createdAt;
    protected $expiresAt;
    protected $followUp;
    protected $paymentInstruction;
    protected $pricingSet;
    protected $updatedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attributes = array();
    }

    public function addAttribute($name, $value) {

        $this->attributes[$name] = $value;
    }

    public function getAttribute($name) {

        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }
    }

    /**
     * @inheritdoc
     */
    public function getFollowUp()
    {
        return $this->followUp;
    }

    public function setPaymentInstruction($paymentInstruction)
    {
        $this->paymentInstruction = $paymentInstruction;
    }

    public function getPaymentInstruction()
    {
        return $this->paymentInstruction;
    }

    /**
     * @inheritdoc
     */
    public function getPricingSet()
    {
        return $this->pricingSet;
    }

    /**
     * @inheritdoc
     */
    public function setFollowUp($followUp)
    {
        $this->followUp = $followUp;
    }

    public function setPrice($name, $price)
    {
        $this->prices[$name] = $price;
    }

    /**
     * @inheritdoc
     */
    public function setPricingSet($pricingSet)
    {
        $this->pricingSet = $pricingSet;
    }

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }
}
