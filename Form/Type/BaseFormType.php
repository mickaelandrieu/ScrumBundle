<?php

namespace NicoB\ScrumBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;

abstract class BaseFormType extends AbstractType {

    private $class;

    public function __construct($class) {
        $this->class = $class;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => $this->class
        ));
    }

    public function getName() {
        return 'will_be_overiden_by_form_factory';
    }

}