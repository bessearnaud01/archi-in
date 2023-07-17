<?php

namespace App\Repository;

use App\Entity\Address;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

class AddressRepository extends ServiceEntityRepository{

    /** @var QueryBuilder $qb */
    protected $qb; 
    protected $alias;
    protected $cnt;

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Address::class);

        $this->alias = "b"; //Il faut modifier les alias à chaque classe qu'on crée une table
        $this->cnt = 1;

    }

//Elle recupere toutes les addresses
public function get() {
    $this->qb = $this->createQueryBuilder($this->alias) // Elle execute les champs de manière décroissant en fonction les noms
    ->orderBy($this->alias, '.canton', 'ASC');  

    return $this;
}
//elle recupere l'id en fonction de ce que tu lui donne en paramètre
public function withId($id){
      $this->qb
      ->andWhere($this->alias. '.id=?' .$this->cnt)
      ->setParameter($this->cnt, $id);
    $this->cnt++;
    return $this;

  }
//Elle recupere la table adresse
public function execute() {
    return $this->qb->getQuery()->getResult();
}
//Elle une adresse
public function executeOne() {
                    try {
                        return $this->qb->getQuery()->getSingleResult();
                    } catch(\Exception $ex) {
                        return null;
                    }
                }







}

