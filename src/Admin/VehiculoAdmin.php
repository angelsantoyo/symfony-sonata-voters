<?php

namespace App\Admin;

use App\Admin\BaseAdmin as Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use App\Entity\Vehiculo;

class VehiculoAdmin extends Admin
{
    
    
    public function createQuery($context = 'list')
    {
        $queryBuilder = $this->getModelManager()->getEntityManager($this->getClass())->createQueryBuilder();
        $user = $this->securityTokenStorage->getToken()->getUser();

        
        if ($this->autorizationChecker->isGranted('ROLE_CONCESIONARIO')) {
            
            $queryBuilder->select('v')
                        ->from($this->getClass(), 'v')
                        ->leftJoin('v.concesionario', 'c')
                        ->where(':user member of c.trabajadores')
                        ->setParameter('user', $user->getId())
            ;
               
        } 
        elseif ($this->autorizationChecker->isGranted('ROLE_PROPIETARIO')) {
            $queryBuilder->select('v')
                        ->from($this->getClass(), 'v')
                        ->where(':user member of v.propietarios')
                        ->setParameter('user', $user->getId())
            ;
        }
        else {
            $queryBuilder->select('p')
                    ->from($this->getClass(), 'p');
            
        }

        $proxyQuery = new ProxyQuery($queryBuilder);
        return $proxyQuery;
    }         
    
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        
        $formMapper
            ->with('Data', array('class' => 'col-xs-12'))
                ->add('name')
                ->add('concesionario')
                ->add('propietarios')
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
            ->add('concesionario')
            ->add('getListPropietarios',null,['label' => 'Propietarios'])
            ->add('_action', 'actions', array(
                'label'=>'Acción',
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
//                     'show' => array(),
//                    'review' => array('label' => 'Revisar','template' => 'admin/button/mejora_review_button.html.twig' ),
                )))
            ;
        ;
    }
    
}

