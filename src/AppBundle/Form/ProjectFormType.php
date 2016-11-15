<?php

namespace AppBundle\Form;

use AppBundle\Entity\OrganizationRole;
use AppBundle\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('projectLeader')
            ->add('projectSecretary')
            ->add('supervisor')
            ->add('startDate')
            ->add('endDate')
            ->add('isLocked');

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class
        ]);
    }

    public function getName()
    {
        return 'app_bundle_organization_role_form_type';
    }
}
