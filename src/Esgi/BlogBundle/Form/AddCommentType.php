<?php

namespace Esgi\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AddCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
            'attr' => array(
                    'class' => 'form-control',
                    'placeholder'   => 'Your name')))
                ->add('text', 'textarea',  array(
            'attr' => array(
                    'class' => 'form-control',
                    'placeholder'   => 'Type your comment', ), ))
                ->add('save', 'submit', array(
                        'label' => 'Publish', 'attr' => array(
                            'class' => 'btn btn-default', ), ));
    }

    public function getName()
    {
        return 'addcommenttype';
    }
}
