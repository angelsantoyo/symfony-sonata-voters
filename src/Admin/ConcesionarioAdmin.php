<?php

namespace App\Admin;

use App\Admin\BaseAdmin as Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use App\Entity\Concesionario;

class ConcesionarioAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        
        $formMapper
            ->with('Data', array('class' => 'col-xs-12'))
                ->add('name')
                ->add('trabajadores')
            ->end()
        ;


    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name',null,array('editable'=>true))
            ->add('_action', 'actions', array(
                'label'=>'Acción',
                'actions' => array(
                    'edit' => array(),
//                     'show' => array(),
//                    'review' => array('label' => 'Revisar','template' => 'admin/button/mejora_review_button.html.twig' ),
                )))
            ;
        ;
    }
    
}

