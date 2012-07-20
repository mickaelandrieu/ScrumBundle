<?php

namespace NicoB\ScrumBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProjectSwitcherFormType extends BaseFormType {

    public function __construct() {
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('project', 'entity', [
                    'class' => 'NicoB\ScrumBundle\Entity\Project',
                    'required' => false
                    ])
        ;
    }

}
