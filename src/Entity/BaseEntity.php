<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class BaseEntity implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */

     protected $id;

     public function getId() {
         return $this->id;
     } 

     public function setId($id) {
         $this->id = $id;
     }

     public abstract function jsonSerialize();


    
}