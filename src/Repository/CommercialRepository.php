<?php

namespace App\Repository;

use App\Entity\Commercial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder; 

class CommercialRepository extends ServiceEntityRepository{

    /** @var QueryBuilder $qb */
    protected $qb; 
    protected $alias;
    protected $cnt;

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Commercial::class);

        $this->alias = "d"; //Il faut modifier les alias à chaque classe qu'on crée une table
        $this->cnt = 1;

    }

//Elle recupere toutes les addresses
public function get() {
    $this->qb = $this->createQueryBuilder($this->alias) // Elle execute les champs de manière décroissant en fonction les noms
    ->orderBy($this->alias, '.ville', 'ASC');  

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
  //elle recupere l'id en fonction de ce que tu lui donne en paramètre
public function withUser($id){
      $this->qb
      ->andWhere($this->alias. '.user_id=?' .$this->cnt)
      ->setParameter($this->cnt, $id);
    $this->cnt++;
    return $this;

  }
//Elle recupere la table commercial
public function execute() {
    return $this->qb->getQuery()->getResult();
}
//Elle represente un commmercial
public function executeOne() {
                    try {
                        return $this->qb->getQuery()->getSingleResult();
                    } catch(\Exception $ex) {
                        return null;
                    }
                }



}

