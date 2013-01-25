<?php

namespace Vespolina\Form\Partner;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PaymentProfileCreditCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address')
            ->add('expiration', 'date', array(
                'days' => array(1),
            ))
            ->add('cardType')
            ->add('cardNumber')
        ;
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Vespolina\Entity\Partner\PaymentProfileType\CreditCard'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vespolina_partner_payment_profile_credit_card';
    }
}
