<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Address;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Service\AddressService;
use App\Service\UserService;
use Doctrine\Persistence\ManagerRegistry;


class AddressController extends AbstractController
{
    // Elle permet de récuperer les addresses
    public function addresses(AddressService $db,ManagerRegistry $m,UserService $dbuser) {
        $db->manager($m);

        $addresses = $db->getAddress()->execute();

        
        return $this->json($addresses);
    }
      //Elle permet de recuperer la fonction address  serait dans le fichier addresses.js

    public function address(AddressService $db,ManagerRegistry $m, $id) {
        $db->manager($m);

        $address = $db->getAddress()->withId($id)->executeOne();
        if($address ===null){
            return $this->json([
             'error'=>"ID non valide"
            ]);
        }
 
        return $this->json($address);
    }


    
} 
  








