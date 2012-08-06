<?php

namespace NicoB\ScrumBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class BacklogFormType extends BaseFormType {


    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('startAt')
                ->add('finishAt')
        ;
    }

}
