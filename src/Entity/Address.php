<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @ORM\Entity(repositoryClass=AddressRepository::class) @ORM\Table(name="address")
 */
 class Address extends BaseEntity
{
   
   
    /**
     * @ORM\Column(type="string", length=255,nullable="true")
     */
    private $entreprise;

    /**
     * @ORM\Column(type="string", length=255,nullable="true")
     */
    private $phone; 

    
    /**
     * @ORM\Column(type="integer",nullable="true")
     */
    private $npa;

    /**
     * @ORM\Column(type="string", length=255,nullable="true")
     */
    private $ville;

    /**
     * @ORM\Column(type="datetime",nullable="true")
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="string", length=255,nullable="true")
     */
    private $rue;



    public function getId(): ?int
    {
        return $this->id;
    }

     public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }
     public function setEntreprise(string $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }


   public function getPhone(): ?string
    {
        return $this->phone;
    }
 public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    

    public function getNpa(): ?int
    {
        return $this->npa;
    }

    public function setNpa(int $npa): self
    {
        $this->npa = $npa;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDate_naissance(): ?\DateTime
    {
        return $this->date_naissance;
    }

    public function setDate_naissance(\DateTime $date_naissance): self
    {
        $this->date_naissance =$date_naissance;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    
     public function jsonSerialize()
    {
     return [
                    'id' => $this->getId(),
                   
                    'entreprise' => $this->getEntreprise(),
                    'date_naissance ' =>$this->getDate_naissance(),
                    'npa' => $this->getNpa(),
                    'rue' => $this->getRue(),
                    'phone' =>$this->getPhone(),
                    'ville' =>$this->getVille(),
                    
                    
                    

            ];
     }
}
