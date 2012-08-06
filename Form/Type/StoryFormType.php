<?php

namespace NicoB\ScrumBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class StoryFormType extends BaseFormType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('description')
                ->add('backlog', null, [
                    'required' => false
                ])
                ->add('status')
                ->add('type')
                ->add('priority')
                ->add('difficulty')
                ->add('assignedAt', null, [
                    'required' => false
                ])
        ;
    }
}
