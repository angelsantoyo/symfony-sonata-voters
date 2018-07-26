<?php
namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Application\SonataUserBundle\Entity\User;
use App\Entity\Vehiculo;

class VehiculoVoter extends Voter
{
    
    public function supports($attribute, $subject)
    {
      
        return $subject instanceof \App\Entity\Vehiculo && in_array($attribute, array(
            'ROLE_APP_ADMIN_VEHICULO_LIST',
            'ROLE_APP_ADMIN_VEHICULO_VIEW',
            'ROLE_APP_ADMIN_VEHICULO_EDIT',
            'ROLE_APP_ADMIN_VEHICULO_CREATE',
            'ROLE_APP_ADMIN_VEHICULO_DELETE',
            'ROLE_APP_ADMIN_VEHICULO_EXPORT',

        ));
    }

    protected function voteOnAttribute($attribute, $object, $token)
    {

        $user = $token->getUser(); 
        
        if (in_array('ROLE_SUPER_ADMIN', $user->getRoles()) or in_array('ROLE_ADMIN', $user->getRoles())) { //Acceso de super admin o admin
            return true;
        }
        
        if (in_array('ROLE_CONCESIONARIO', $user->getRoles())) { //Acceso de concesionario
            foreach($user->getConcesionarios() as $concesionario) {
                if ($concesionario->getVehiculos()->contains($object))
                    return true;
            }
        }
        
        if (in_array('ROLE_PROPIETARIO', $user->getRoles())) { //Acceso de propietario
            if ($user->getVehiculos()->contains($object)) 
                return true;
        }
        
        return false;
    }

}