<?php

namespace Test\Form\Fieldset;

use Test\Entity\SimpleMessage;
use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods;

class SimpleMessageFieldset extends Fieldset
{
    public function __construct()
    {
        parent::__construct('simpleMessage');
        $this->setObject(new SimpleMessage())
             ->setHydrator(new ClassMethods());
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'subject',
            'options' => array(
                'label' => 'Sujet :',
                'labelAttributes' => array(
                    'class' => 'long',
                    'for' => 'label_subject'
                ),
                'attributes' => array(
                    'id' => 'label_subject',
                    'class' => 'long',
                    'tabindex' => 4,
                    'maxlength' => 100
                )
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'message',
            'options' => array(
                'label' => 'Message :',
                'labelAttributes' => array(
                    'class' => 'long',
                    'for' => 'label_message'
                ),
                'attributes' => array(
                    'id' => 'label_message',
                    'class' => 'mceEditor',
                    'tabindex' => 5
                )
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'copy_email',
            'options' => array(
                'label' => 'Recevoir une copie de ce message par email :',
                'labelAttributes' => array(
                    'class' => 'checkbox',
                    'for' => 'label_copy_email'
                ),
                'attributes' => array(
                    'id' => 'label_copy_email',
                    'class' => 'checkbox',
                    'tabindex' => 6
                )
            )
        ));
    }
    public function getInputFilterSpecification()
    {
        return array(
            'subject' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags')
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'max' => 100
                        )
                    )
                )                
            ),
            'message' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags')
                )
            ),
            'copy' => array(
                'required' => false
            )
        );
    }
}
