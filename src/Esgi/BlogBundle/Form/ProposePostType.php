<?php

namespace Esgi\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProposePostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array(
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('body', 'genemu_tinymce', array(
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('category', 'entity', array(
                    'class' => 'BlogBundle:Category',
                    'property' => 'name',
                    'expanded' => false,
                    'multiple' => false,
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('file')
                ->add('save', 'submit', array('label' => 'Propose',
                    'attr' => array('class' => 'btn btn-success'),
                ));
    }

    public function getName()
    {
        return 'proposeposttype';
    }
}
