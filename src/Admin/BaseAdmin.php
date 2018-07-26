<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;

class BaseAdmin extends AbstractAdmin
{
    
    /**
     * Security Token Storage
     * @var \Symfony\Component\Security\Core\Security\TokenStorage
     */
    protected $securityTokenStorage;
    public $autorizationChecker;
    public $logger;

    public function setSecurityTokenStorage($securityTokenStorage)
    {
        $this->securityTokenStorage = $securityTokenStorage;
    }
    
    public function setAutorizationChecker($autorizationChecker)
    {
        $this->autorizationChecker = $autorizationChecker;
    }
    
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getRequest()
    {
        if (!$this->request) {
            //  throw new \RuntimeException('The Request object has not been set');
            $this->request = $this->getConfigurationPool()->getContainer()->get('Request');
        }

        return $this->request;
    }
    
    /**
     * Obtener baseId en función del usuario
     * 
     */
    /*public function getBaseId() 
    {
        if ($this->securityContext->isGranted('ROLE_SUPER_ADMIN')) {
            return null;
        }
        else {
            $base = $this->securityContext->getToken()->getUser()->getBase();
            if ($base)
               return $base->getId();
        }
        
    } */   

}