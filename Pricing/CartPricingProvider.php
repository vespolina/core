<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\CartBundle\Pricing;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use Vespolina\CartBundle\PricingProviderInterface;

/**
 * @author Daniel Kucharski <develop@zestic.com>
 */
abstract class PricingProvider implements PricingProviderInterface
{


    public function setCartState(CartInterface $cart, $state, $flush = true)
    {
        $rp = new \ReflectionProperty($cart, 'state');
        $rp->setAccessible(true);
        $rp->setValue($cart, $state);
        $rp->setAccessible(false);

        if ($flush) {
            $this->updateCart($cart);
        }
    }
}
