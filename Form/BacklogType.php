<?php

namespace NicoB\ScrumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BacklogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('createdAt')
            ->add('startAt')
            ->add('finishAt')
            ->add('project')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NicoB\ScrumBundle\Entity\Backlog'
        ));
    }

    public function getName()
    {
        return 'nicob_scrumbundle_backlogtype';
    }
}
