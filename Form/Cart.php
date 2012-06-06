<?php

namespace Vespolina\CartBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class Cart extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('items', 'collection', array('type' => new CartItem()));
    }

    public function getDefaultOptions()
    {
        return array(
            'data_class' => 'Vespolina\CartBundle\Entity\Cart',
        );
    }

    public function getName()
    {
        return 'cart';
    }
}
