<?php

namespace Test\Form\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class Contact extends Form
{
    public function __construct()
    {
        parent::__construct('mailto-form');
        $this->setHydrator(new ClassMethods());
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->add(array(
            'type' => 'Test\Form\Fieldset\WebIdentityFieldset',
            'name' => 'webIdentity',            
        ));
        $this->add(array(
            'type' => 'Test\Form\Fieldset\SimpleMessageFieldset',
            'name' => 'simpleMessage',            
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Envoyer',
                'class' => 'bouton_form',
                'tabindex' => 7,
                'title' => '$default title'
            )
        ));
    }    
}