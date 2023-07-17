<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=App\Repository\CommercialRepository::class)
 */
class Commercial extends BaseEntity
{
   /**
      * @ORM\ManyToOne(targetEntity="User",inversedBy="commercial",cascade={"persist"})  
      */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $npa;
     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;
    
     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rue;
    

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $canton;


     /**
     * @ORM\Column(type="float", length=9, nullable=true)
     */
    private $prix;

     /**
      * @ORM\Column(type="json",nullable =true)
      * @var array
      */
      private $images;

        public function __construct()
        {
           $this->images=[];
        }

 public function getUser(): ?User
    {
        return $this->user;
    }
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }


 public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }


    public function getNpa(): ?int
    {
        return $this->npa;
    }

    public function setNpa(?int $npa): self
    {
        $this->npa = $npa;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(?string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }


    
    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getCanton(): ?string
    {
        return $this->canton;
    }
     public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
     public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setCanton(?string $canton): self
    {
        $this->canton = $canton;

        return $this;
    }


    public function getImages()
    {
        return $this->images;
    }
    

     /**
      * Set the value of images
      *
      * @return  self
      */ 
     public function setImages($images)
     {
          $this->images = $images;

          return $this;
     }

     /**
      * Set the value of images
      *
      * @return  self
      */ 
     public function addImage($image)
     {
          $this->images[] = $image;

          return $this;
     }


     public function jsonSerialize()
    {
     return [
                    'id' => $this->getId(),
                    'status' =>$this->getStatus(),
                    'ville' => $this->getVille(),
                    'type' =>$this->getType(),
                    'prix' =>$this->getPrix(),
                    'npa' => $this->getNpa(),
                    'rue' => $this->getRue(),
                    'images' => $this->getImages(), 
                    'canton' =>$this->getCanton(),
                    
                                   

            ];
     }















}
