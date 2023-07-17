<?php 


namespace App\Service;
use App\Entity\User;
use App\Entity\Commercial;
use App\Entity\Address;
use App\Repository\CommercialRepository;
use Doctrine\Persistence\ManagerRegistry;

class CommercialService
{
    /** @var ManagerRegistry $doctrine*/
    protected $doctrine;

    // setter pour le manager de doctrine -----------------------------------------------------------
    public function manager(ManagerRegistry $doctrine) {
        $this->doctrine = $doctrine;
    }

    // Fonctions pour récupérer les données d'une table de la bdd -----------------------------------
    /**
     * @return CommercialRepository
     */
    public function getCommercial() {
        /** @var CommercialRepository $repo */
        $repo = $this->doctrine->getRepository(Commercial::class);

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
