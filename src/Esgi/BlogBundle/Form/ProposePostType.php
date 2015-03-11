<?php

namespace Esgi\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProposePostType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('title')
				->add('body')
				->add('save', 'submit', array('label' =>'Propose'));
	}

	public function getName()
	{
		return 'proposeposttype';
	}
}
