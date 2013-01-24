<?php

namespace Vespolina\Form\Partner;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PartnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['is_admin']) {
            $builder
                ->add('payByCreditCard', 'choice', array(
                    'label' => 'Payment Method',
                    'choices'   => array(1 => 'Credit', 0 => 'Invoice'),
                    'multiple'  => false,
                    'expanded' => true,
                ))
            ;
        }

        $builder
            ->add('name')
            ->add('type')
            ->add('currency')
            ->add('language')
            ->add('paymentTerms')
            ->add('personalDetails', new PersonalDetailsType())
            ->add('organisationDetails', new OrganisationDetailsType())
            ->add('primaryContact', new ContactType())
            ->add('addresses', 'collection', array(
                'type' => new AddressType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'options' => array(
                    'required' => false,
                    'attr' => array('class' => 'license-box')
                )
            ))
        ;

    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Vespolina\Entity\Partner\Partner',
            'is_admin' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vespolina_partner_partner';
    }
}
