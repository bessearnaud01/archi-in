<?php 


namespace App\Service;
use App\Entity\User;
use App\Entity\Address;
use App\Repository\AddressRepository;
use Doctrine\Persistence\ManagerRegistry;

class AddressService
{
    /** @var ManagerRegistry $doctrine*/
    protected $doctrine;

    // setter pour le manager de doctrine -----------------------------------------------------------
    public function manager(ManagerRegistry $doctrine) {
        $this->doctrine = $doctrine;
    }

    // Fonctions pour récupérer les données d'une table de la bdd -----------------------------------
    /**
     * @return AddressRepository
     */
    public function getAddress() {
        /** @var AddressRepository $repo */
        $repo = $this->doctrine->getRepository(Address::class);

        return $repo->get();
    }

     // Elle doit être dans le fichier ApiController
    public function delete($entity) {
        $this->doctrine->getManager()->remove($entity);
        $this->doctrine->getManager()->flush();
    }

 
    //sauvegarder les données dans la bdd ----------------------------------------------------------
    public function save($entity) {
        $this->doctrine->getManager()->persist($entity);
        $this->doctrine->getManager()->flush();
    }
    
 //On a besion de l'id de l'adresse et du user lorsqu on remplit le formulaire adresse
// Fonctions pour récupérer les données d'une table de la bdd -----------------------------------
    /**
     * @return userRepository
     */
    public function getUser() {
        /** @var UserRepository $repo */
        $repo = $this->doctrine->getRepository(User::class);

        return $repo->get();
    }











}
