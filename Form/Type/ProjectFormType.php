<?php

namespace NicoB\ScrumBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;


class ProjectFormType extends BaseFormType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
        ;
    }
}
