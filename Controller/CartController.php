<?php
/**
 * (c) 2011-2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Form\Cart as CartForm;

/**
 * @author Richard D Shank <develop@zestic.com>
 */

class CartController extends ContainerAware
{
    public function addToCartAction($cartableId, $cartId = null)
    {
        $cartable = $this->findCartableById($cartableId);

        $cart = $this->getCart($cartId);
        $this->container->get('vespolina.cart_manager')->addItemToCart($cart, $cartable);

        return new RedirectResponse($this->container->get('router')->generate('vespolina_cart_show', array('cartId' => $cartId)));
    }

    public function removeFromCartAction($cartableId, $cartId = null)
    {
        $cart = $this->getCart($cartId);
        $cartable = $this->findCartableById($cartableId);

        $this->container->get('vespolina.cart_manager')->removeItemFromCart($cart, $cartable);

        return new RedirectResponse($this->container->get('router')->generate('vespolina_cart_show', array('cartId' => $cartId)));
    }

    public function updateCartAction ($cartId = null)
    {
        $request = $this->container->get('request');
        if ($request->getMethod() == 'POST')
        {
            $cart = $this->getCart();
            $data = $request->get('cart');
            foreach ($data['items'] as $item)
            {
                $cartableItem = $this->findCartableById($item['cartableItem']['id']);
                if ($item['quantity'] < 1)
                {
                    $this->container->get('vespolina.cart_manager')->removeItemFromCart ($cart, $cartableItem);
                } elseif ($cartItem = $this->container->get('vespolina.cart_manager')->findItemInCart($cart, $cartableItem)) {
                    $this->container->get('vespolina.cart_manager')->setItemQuantity($cartItem, $item['quantity']);
                }
            }

            $this->container->get('vespolina.cart_manager')->determinePrices($cart);
        }

        return new RedirectResponse($this->container->get('router')->generate('vespolina_cart_show' ));

    }

    public function showAction($cartId = null)
    {
        $cart = $this->getCart($cartId);
        $form = $this->container->get('form.factory')->create(new CartForm(), $cart);

        $template = $this->container->get('templating')->render(sprintf('VespolinaCartBundle:Cart:show.html.%s', $this->getEngine()), array('cart' => $cart, 'form' => $form->createView()));

        return new Response($template);
    }

    protected function findCartableById($productId)
    {
        return $this->container->get('vespolina.product_manager')->findProductById($productId);
    }

    protected function getCart($cartId = null)
    {
        if ($cartId) {
            return $this->container->get('vespolina.cart_manager')->findCartById($cartId);
        } else {
            return $this->container->get('vespolina.cart_manager')->getActiveCart();
        }
    }

    protected function getEngine()
    {
        return $this->container->getParameter('vespolina_cart.template.engine');
    }
}
