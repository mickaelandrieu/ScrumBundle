<?php

namespace NicoB\ScrumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('createdAt')
            ->add('name')
            ->add('description')
            ->add('sandbox')
            ->add('backlog')
            ->add('status')
            ->add('type')
            ->add('priority')
            ->add('difficulty')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NicoB\ScrumBundle\Entity\Story'
        ));
    }

    public function getName()
    {
        return 'nicob_scrumbundle_storytype';
    }
}