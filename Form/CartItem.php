<?php

namespace Vespolina\CartBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CartItem extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cartableItem', new CartableItem());
        $builder->add('quantity', 'integer', array('required' => true ));
    }

    public function getDefaultOptions()
    {
        return array(
            'data_class' => 'Vespolina\CartBundle\Model\CartItem',
            'cascade_validation' => true,
        );
    }

    public function getName()
    {
        return 'items';
    }

}
