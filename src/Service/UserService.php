<?php 


namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserService
{
    /** @var ManagerRegistry $doctrine*/
    protected $doctrine;

    // setter pour le manager de doctrine -----------------------------------------------------------
    public function manager(ManagerRegistry $doctrine) {
        $this->doctrine = $doctrine;
    }

    // Fonctions pour récupérer les données d'une table de la bdd -----------------------------------
    /**
     * @return userRepository
     */
    public function getUser() {
        /** @var UserRepository $repo */
        $repo = $this->doctrine->getRepository(User::class);

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
    

    
   












}
