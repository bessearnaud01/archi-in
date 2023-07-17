<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User extends BaseEntity implements UserInterface, PasswordAuthenticatedUserInterface
 {


     /**
     * @ORM\Column(type="string", length=255)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;
    
     /**
      * @ORM\Column(type="json")
      */
      private $roles= [];

     /**
      * @ORM\OneToMany(targetEntity="Commercial",mappedBy="user",cascade={"persist"})  
      */
       private $commercial;
     /**
      * @ORM\ManyToOne(targetEntity="Address",cascade={"persist"})  
      */
      private $address;
    /**
     * @ORM\Column(type="string", length=255 ,unique=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motdepasse;
    
    public function __construct() // avatar est une image donc on créer donc avant qu'on ne crée address elle doit avoir un champs vide
    {
        $this->setAvatar('');
    }
    public function setAvatar(string  $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
    
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

     public function getAddress() {
        return $this->address;
    }
   
    public function getCommercial() {
        return $this->commercial !== null? $this->commercial:new Collection (); //si c est le commercial est vide il me renvoie un tableau vide
    }
   public function setCommercial($commercial) {
        $this->commercial=$commercial;
    }

  public function addCommercial(Commercial $commercial) {
        $this->commercial->add($commercial);
        $commercial->setUser($this);
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }
    
    public function getRoles()

    {    $roles =  $this->roles;

         $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
    public function getPassword(): ?string
    {
        return $this->motdepasse;
    }

    public function setPassword(string $motdepasse): self
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }
    
    public function getUserIdentifier()
    {
        return(string) $this->mail;
    }

    public function getUsername()
    {
        return(string) $this->mail;
    }
    
  //Si elle permet d'hache le mot de passe
  public function getSalt()
  {
      return null;
  }

  //quand tu t es loge est ce que tu as fais quelques chose de plus
  public function eraseCredentials()
  {
      
  }




     //Elle permet de retourne les données sous forme de tableau
     public function jsonSerialize()
    {
     $data = [
                    'id' => $this->getId(),
                    'nom' =>$this->getNom(),
                    'prenom' => $this->getPrenom(), 
                    'mail' =>$this->getMail(),
                    'avatar' =>$this->getAvatar(),
                    'address'=>[], //Lorsqu'on ajoute un user elle met null dans le champs utilisateur et elle vous aidez a choisit notre adresse alors elle aura un id
                    'commercial'=>$this->getCommercial() //Elle appartient à l entite commerce
            ];
              if($this ->getAddress() !== null){
              $data['address'] =[
                'id' => $this->getAddress()->getId(),
                'date_naissance' =>$this->getAddress()->getDate_naissance(),
                'npa' => $this->getAddress()->getNpa(), 
                'rue' => $this->getAddress()->getRue(),
                'ville' => $this->getAddress()->getVille(),
                'entreprise' =>$this->getAddress()->getEntreprise(),
                'phone' =>$this->getAddress()->getPhone(),
                'date_naissance' =>$this->getAddress()->getDate_naissance(),

           ];


        
        
        }
            return $data; 
            
            
        }
     
      
 }


