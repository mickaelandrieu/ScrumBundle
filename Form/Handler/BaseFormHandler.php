<?php

namespace NicoB\ScrumBundle\Form\Handler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;


abstract class BaseFormHandler {

    protected $request;
    protected $form;
    protected $manager;

    public function __construct(Form $form, Request $request) {
        $this->request = $request;
        $this->form = $form;
    }

    public function getForm() {
        return $this->form;
    }
    
    public function setManager($manager) {
        $this->manager = $manager;
    }

    public function process($entity = null) {
        
        if ($entity)
            $this->form->setData($entity);
        if ('POST' == $this->request->getMethod()) {
            $this->form->bindRequest($this->request);
            if ($this->form->isValid()) {
                $this->onSuccess();
                return true;
            }
        }
        return false;
    }

    public function onSuccess() {
    }
}