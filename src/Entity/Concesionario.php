<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
// use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Concesionario
 *
 * @ORM\Table(name="concesionario")
 * @ORM\Entity() 
 */
class Concesionario
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
     * @ORM\OneToMany(targetEntity="Vehiculo", mappedBy="concesionario" )
     *  
     */
    private $vehiculos;         
    
    
    /**
     * @ORM\ManyToMany(targetEntity="App\Application\Sonata\UserBundle\Entity\User", inversedBy="concesionarios") 
     * @ORM\JoinTable(name="concesionario_trabajador")
     * 
     */
    private $trabajadores;        

      
    
    
    public function __toString()
    {
        if ($this->getId())
            return $this->getName();
        else 
            return "new Group";     
    }
    
    public function __construct() 
    {
        $this->vehiculos = new ArrayCollection();
        $this->trabajadores = new ArrayCollection();
    }     
    
    
  
    
    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    
    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Concesionario
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }    
    
    
    
    /**
     * Set name
     *
     * @param string $name
     * @return Concesionario
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
     * Trabajadores
     * 
     */
    public function getTrabajadores()
    {
        return $this->trabajadores;
    }
    
    public function addTrabajador( $trabajador)
    {
        if (!$this->trabajadores->contains($trabajador))
            $this->trabajadores->add($trabajador);
    }
    
    public function removeTrabajador( $trabajador)
    {
        if ($this->trabajadores->contains($trabajador))
            return $this->trabajadores->removeElement($trabajador);
    }  
    
    public function getListTrabajadores()
    {
        return implode(", ",$this->getTrabajadores()->toArray());
    }       
  
  
    /**
     * Vehiculos
     * 
     */
    public function getVehiculos()
    {
        return $this->vehiculos;
    }
    
    public function setVehiculos($vehiculos)
    {
//         echo "A"; die();

        
        $this->vehiculos = $vehiculos;
        foreach($vehiculos as $vehiculo) 
            $vehiculo->addConcesionario($this);        
        return $this;
    }
    
    public function addVehiculo(Vehiculo $vehiculo)
    {
//         echo "A"; die();
        
        
        if ($this->vehiculos->contains($vehiculo)) {
            return;
        }
        $this->vehiculos->add($vehiculo);
        $vehiculo->addConcesionario($this);
        
    }
    
    public function removeVehiculo(Vehiculo $vehiculo)
    {
//         echo "R"; die();
        if (!$this->vehiculos->contains($vehiculo)) {
            return;
        }
        $this->vehiculos->removeElement($vehiculo);
        $vehiculo->removeConcesionario($this);
        
    }
    
    public function getListVehiculos()
    {
        return implode(", ",$this->getVehiculos()->toArray());
    }  
    
    
}
