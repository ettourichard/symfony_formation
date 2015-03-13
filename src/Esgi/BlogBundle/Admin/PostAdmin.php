<?php

namespace Esgi\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PostAdmin extends Admin
{
    // setup the defaut sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'created_at',
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('title')
            ->add('body')
            ->add('author')
            ->add('category', 'sonata_type_model_autocomplete', array('property' => 'name'))
            ->add('activeComment')
            ->add('isPublished', 'checkbox', array('required' => false))
            ->add('file', 'file', array('required' => false))
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('body')
            ->add('author')
            ->add('activeComment')
            ->add('isPublished')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('title')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ))
        ;
    }

    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('file')
            ->add('body')
            ->add('author')
            ->add('activeComment')
            ->add('category')
        ;
    }

    public function prePersist($product)
    {
        $this->saveFile($product);
    }

    public function preUpdate($product)
    {
        $this->saveFile($product);
    }

    public function saveFile($product)
    {
        $basepath = $this->getRequest()->getBasePath();
        $product->upload($basepath);
    }
}
