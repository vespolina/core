<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\CartBundle\Entity;

use Symfony\Component\DependencyInjection\Container;
use Doctrine\ORM\EntityManager;

use Vespolina\CartBundle\Entity\Cart;
use Vespolina\CartBundle\Model\CartableItemInterface;
use Vespolina\CartBundle\Model\CartInterface;
use Vespolina\CartBundle\Model\CartItemInterface;
use Vespolina\CartBundle\Model\CartManager as BaseCartManager;
/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
class CartManager extends BaseCartManager
{
    protected $cartClass;
    protected $cartRepo;
    protected $em;
    protected $primaryIdentifier;

    public function __construct(EntityManager $em, CartPricingProviderInterface $pricingProvider = null, $cartClass, $cartItemClass)
    {
        $this->em = $em;

        $this->cartClass = $cartClass;
        $this->cartRepo = $this->em->getRepository($cartClass);

        parent::__construct($pricingProvider, $cartClass, $cartItemClass);
    }

    public function addItemToCart(CartInterface $cart, CartableItemInterface $cartableItem)
    {
        $item = $this->createItem($cartableItem);
        $cart->addItem($item);
        // todo: just update this cart, don't flush everything
        if ($cart->getId() !== $cart->getId()) {
            $this->em->createQueryBuilder($this->cartClass)
                ->findAndUpdate()
                ->field('id')->equals($cart->getId())
                ->field('items')->set($cart->getItems())
                ->getQuery()
                ->execute()
            ;
        } else {
            $this->updateCart($cart);
        }
    }

    public function findOpenCartByOwner($owner)
    {

        if ($owner) {

            $q = $this->em->createQueryBuilder($this->cartClass)
                            ->select('c')
                            ->from('Vespolina\CartBundle\Entity\Cart', 'c')
                            ->where('c.owner = ?1')
                            ->andWhere('c.state = ?2')
                            ->getQuery();
            $q->setMaxResults(1);   //Temp
            $q->setParameters(array(1 => $owner, 2 => Cart::STATE_OPEN));

            return $q->getSingleResult();
        }

    }

    /**
     * @inheritdoc
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->cartRepo->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @inheritdoc
     */
    public function findCartById($id)
    {
        return $this->cartRepo->find($id);
    }

    /**
     * @inheritdoc
     */
    public function findCartByIdentifier($name, $code)
    {

           return;
    }

    /**
     * @inheritdoc
     */
    public function updateCart(CartInterface $cart, $andFlush = true)
    {
        $this->em->persist($cart);
        if ($andFlush) {
            $this->em->flush();
        }
    }
}
