<?php

namespace AppBundle\Form;

use AppBundle\Entity\Genus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenusFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    $builder
        ->add('name')
        ->add('speciesCount')
        ->add('subFamily', null, [
            'placeholder' => 'Choose a Sub Family'
        ])
        ->add('funFact')
        ->add('isPublished', ChoiceType::class,[
            'choices' => [
                'Yes' => true,
                'No' => false,
            ]
        ])
        ->add('firstDiscoveredAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Genus::class
        ]);
    }

    public function getName()
    {
        return 'app_bundle_genus_form_type';
    }
}