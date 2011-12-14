<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\OrderBundle\Document;

use Symfony\Component\DependencyInjection\Container;

use Vespolina\OrderBundle\Document\SalesOrder;
use Vespolina\OrderBundle\Model\SalesOrderInterface;
use Vespolina\OrderBundle\Model\SalesOrderItemInterface;
use Vespolina\OrderBundle\Model\SalesOrderManager as BaseSalesOrderManager;
/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
class SalesOrderManager extends BaseSalesOrderManager
{
    protected $dm;
    protected $primaryIdentifier;
    protected $salesOrderRepo;
    
    public function __construct(Container $container)
    {
        $this->dm = $container->get('doctrine.odm.mongodb.default_document_manager');
        $this->salesOrderRepo = $this->dm->getRepository('Vespolina\OrderBundle\Document\SalesOrder'); // TODO make configurable

        parent::__construct($container);
    }

    /**
     * @inheritdoc
     */
    public function createSalesOrder($salesOrderType = 'default')
    {
        // TODO: this will be using factories to allow for a number of different types of SalesOrder classes
        $salesOrder = new SalesOrder();
        $this->init($salesOrder);

        return $salesOrder;
    }


    /**
     * @inheritdoc
     */
    public function createItem(SalesOrderInterface $salesOrder) {

       $salesOrderItem = new SalesOrderItem();
       $this->initItem($salesOrderItem);

       $salesOrder->addItem($salesOrderItem);

       return $salesOrderItem;
    }


    /**
     * @inheritdoc
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->salesOrderRepo->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @inheritdoc
     */
    public function findSalesOrderById($id)
    {

        return $this->salesOrderRepo->find($id);
    }

    /**
     * @inheritdoc
     */
    public function findSalesOrderByIdentifier($name, $code)
    {

    }

    /**
     * @inheritdoc
     */
    public function updateSalesOrder(SalesOrderInterface $salesOrder, $andFlush = true)
    {
        $this->dm->persist($salesOrder);
        if ($andFlush) {
            $this->dm->flush();
        }
    }
}
