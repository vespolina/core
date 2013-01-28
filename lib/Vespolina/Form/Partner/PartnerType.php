<?php

namespace Vespolina\Form\Partner;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Vespolina\Entity\Partner\PaymentProfile;

class PartnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
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
            ->add('paymentProfileType', 'choice', array(
                'label' => 'Payment Method',
                'choices'   => array_combine(PaymentProfile::$validTypes, PaymentProfile::$validTypes),
                'required'  => true,
                'multiple'  => false,
                'expanded' => true,
            ))
        ;

        if (isset($options['paymentProfileFormTypeClass'])) {
            $builder->add('paymentProfile', new $options['paymentProfileFormTypeClass']);
        }
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Vespolina\Entity\Partner\Partner',
            'paymentProfileFormTypeClass' => false
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
