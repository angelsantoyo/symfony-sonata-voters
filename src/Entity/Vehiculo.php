<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
// use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Vehiculo
 *
 * @ORM\Table(name="vehiculo")
 * @ORM\Entity() 
 */
class Vehiculo
{
//     use TimestampableEntity;
 
     /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    
   
    
    /**
    * @ORM\Column(name="name", type="string", length=128)
    */
    private $name;

    
    
    /**
     * @ORM\ManyToOne(targetEntity="Concesionario",  inversedBy="vehiculos")
     
     */    
    private $concesionario;    
    
    
    
    /**
     * @ORM\ManyToMany(targetEntity="App\Application\Sonata\UserBundle\Entity\User", inversedBy="vehiculos") 
     * @ORM\JoinTable(name="vehiculo__propietario")
     * 
     */
    private $propietarios;        
    
    

    
    
    public function __toString()
    {
        if ($this->getId())
            return $this->getName();
        else
            return "new Vehiculo";
    }
    
    public function __construct() 
    {

        $this->propietarios = new ArrayCollection();
        
    }     
   
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    
    
    
    /**
     * Set name
     *
     * @param string $name
     * @return Vehiculo
     */  
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }     
    

    /**
     * Get name
     *
     * @return string 
     */    
    public function getName()
    {
        return $this->name;
    }
  
    /**
     * Set concesionario
     *
     * @param string $concesionario
     * @return Vehiculo
     */  
    public function setConcesionario($concesionario)
    {
        $this->concesionario = $concesionario;
        return $this;
    }     
    

    /**
     * Get concesionario
     *
     * @return string 
     */    
    public function getConcesionario()
    {
        return $this->concesionario;
    }

    

    
    /**
     * Managers
     * 
     */
//     public function getManagers()
//     {
//         return $this->managers;
//     }
//     
//     public function addManager( $manager)
//     {
//         if (!$this->managers->contains($manager))
//             $this->managers->add($manager);
//     }
//     
//     public function removeManager( $manager)
//     {
//         if ($this->managers->contains($manager))
//             return $this->managers->removeElement($manager);
//     }  
//     
//     public function getListManagers()
//     {
//         return implode(", ",$this->getManagers()->toArray());
//     }    
    
    /**
     * Propietarios
     * 
     */
    public function getPropietarios()
    {
        return $this->propietarios;
    }
    
    public function addPropietario( $manager)
    {
        if (!$this->propietarios->contains($manager))
            $this->propietarios->add($manager);
    }
    
    public function removePropietario( $manager)
    {
        if ($this->propietarios->contains($manager))
            return $this->propietarios->removeElement($manager);
    }  
    
    public function getListPropietarios()
    {
        return implode(", ",$this->getPropietarios()->toArray());
    }        
    

    
    /**
     * Get Vehiculos
     *
     * @return ArrayCollection 
     */
    public function getVehiculos()
    {
        return $this->vehiculos;
    }           
    
    
}
