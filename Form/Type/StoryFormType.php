<?php

namespace NicoB\ScrumBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StoryFormType extends AbstractType {

    use BaseFormType;

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
