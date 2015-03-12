<?php

namespace Esgi\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProposePostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text')
                ->add('body', 'genemu_tinymce')
                ->add('category', 'entity', array(
                    'class' => 'BlogBundle:Category',
                    'property' => 'name',
                    'expanded' => false,
                    'multiple' => false,
                ))
                ->add('save', 'submit', array('label' => 'Propose'));
    }

    public function getName()
    {
        return 'proposeposttype';
    }
}
