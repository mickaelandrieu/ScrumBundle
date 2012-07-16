<?php

namespace NicoB\ScrumBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectSwitcherFormType extends AbstractType {

    use BaseFormType;

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('project','entity',['class'=>'NicoB\ScrumBundle\Entity\Project'])
        ;
    }
}
