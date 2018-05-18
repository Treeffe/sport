<?php

namespace sport\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('nomUser', 'text')
        	->add('prenomUser', 'text')
            ->add('username', 'text')
            ->add('password', 'repeated', array(
                'type'            => 'password',
                'invalid_message' => 'mot de passe incorrecte.',
                'options'         => array('required' => true),
                'first_options'   => array('label' => 'Password'),
                'second_options'  => array('label' => 'Repeat password'),
            ));
    }

    public function getName()
    {
        return 'user';
    }
}
