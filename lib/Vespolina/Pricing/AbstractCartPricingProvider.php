<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Pricing;

use Vespolina\CartBundle\Handler\CartHandlerInterface;
use Vespolina\CartBundle\Model\CartItemInterface;
use Vespolina\CartBundle\Pricing\CartPricingProviderInterface;
use Vespolina\CartBundle\Pricing\PricingSet;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
abstract class AbstractCartPricingProvider implements CartPricingProviderInterface
{
    protected $handlers;
    protected $taxationManager;

    public function __construct()
    {
        $this->handlers = array();
    }

    public function createPricingSet()
    {
        return new PricingSet();
    }

    public function addCartHandler(CartHandlerInterface $handler)
    {
        $types = (array)$handler->getTypes();
        foreach ($types as $type) {
            $this->handlers[$type] = $handler;
        }

        $handler->setTaxationManager($this->taxationManager);
    }

    public function setTaxationManager($taxationManager)
    {
        $this->taxationManager = $taxationManager;
    }

    protected function getCartHandler(CartItemInterface $cartItem)
    {
        $type = $cartItem->getCartableItem()->getType();
        if (!isset($this->handlers[$type])) {

            //Fall back to the default handler
            return $this->handlers['default'];
        }

        return $this->handlers[$type];
    }
}
