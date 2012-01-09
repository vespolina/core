<?php
/**
 * (c) 2011 - 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

use Vespolina\CartBundle\Model\CartInterface;

/**
 * @author Richard D Shank <develop@zestic.com>
 */

class PartialsController extends ContainerAware
{
    public function cartAction($id)
    {
        $cart = $this->container->get('vepolina.cart_manager')->findCartById($id);
        return $this->container->get('templating')->renderResponse('VespolinaCartBundle:Partials:cart.html.'.$this->getEngine(), array(
            'cart' => $cart,
        ));
    }

    protected function getEngine()
    {
        return $this->container->getParameter('vespolina_cart.template.engine');
    }
}
