<?php

namespace Test\Form\Fieldset;

use Test\Entity\WebIdentity;
use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods;

class WebIdentityFieldset extends Fieldset
{
    public function __construct()
    {
        parent::__construct('webIdentity');
        $this->setObject(new WebIdentity())
             ->setHydrator(new ClassMethods());
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'name',
            'options' => array(
                'label' => 'Nom :',
                'labelAttributes' => array(
                    'class' => 'court',
                    'for' => 'label_name'
                ),
                'attributes' => array(
                    'id' => 'label_name',
                    'class' => 'court',
                    'tabindex' => 1,
                    'maxlength' => 50
                )
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'firstname',
            'options' => array(
                'label' => 'Prénom :',
                'labelAttributes' => array(
                    'class' => 'court',
                    'for' => 'label_firtsname'
                ),
                'attributes' => array(
                    'id' => 'label_firstname',
                    'class' => 'court',
                    'tabindex' => 2,
                    'maxlength' => 30
                )
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Email',
            'name' => 'email',
            'options' => array(
                'label' => 'Adresse email :',
                'labelAttributes' => array(
                    'class' => 'court',
                    'for' => 'label_email'
                ),
                'attributes' => array(
                    'id' => 'label_email',
                    'class' => 'court',
                    'tabindex' => 3,
                )
            )
        ));
    }
    public function getInputFilterSpecification()
    {
        return array(
            'name' => array(
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
                            'max' => 50
                        )
                    )
                )                
            ),
            'firstname' => array(
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
                            'max' => 30
                        )
                    )
                )                
            ),
            'email' => array(
                'required' => false
            )
        );
    }
}
