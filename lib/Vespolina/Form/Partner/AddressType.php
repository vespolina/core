<?php

namespace Vespolina\Form\Partner;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('street')
            ->add('number')
            ->add('numbersuffix')
            ->add('zipcode')
            ->add('city')
            ->add('state')
            ->add('country')
        ;
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Vespolina\Entity\Partner\Address'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vespolina_partner_address';
    }
}