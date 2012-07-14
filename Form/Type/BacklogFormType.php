<?php

namespace NicoB\ScrumBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BacklogFormType extends AbstractType {

    use BaseFormType;

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('startAt')
                ->add('finishAt')
                ->add('project')
        ;
    }

}
