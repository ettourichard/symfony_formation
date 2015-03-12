<?php

namespace Esgi\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AddCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('text', 'textarea')
                ->add('save', 'submit', array('label' => 'Comment'));
    }

    public function getName()
    {
        return 'addcommenttype';
    }
}
