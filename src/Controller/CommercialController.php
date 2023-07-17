<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Commercial;

use App\Entity\User;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Service\CommercialService;
use App\Service\UserService;
use Doctrine\Persistence\ManagerRegistry;


class CommercialController extends AbstractController
{
    // Elle permet de récuperer les biens commerciaux en fonction de l'user
     
    public function getCommerciaux(CommercialService $db,ManagerRegistry $m) {
        $db->manager($m);
        /** @var User $user */
        $user = $this->getUser();
        $commerce = $user->getCommercial();
        return $this->json($commerce);
    }

//On ajoute les images commercial

  public function UpdateImage(UserService $db,ManagerRegistry $m, CommercialService $cs,$id) {
        $db->manager($m);
        $cs->manager($m);
        /** @var User */
       $user = $this->getUser();//getUser est une fonction symfony qui permet de recuperer l'utlisateur elle est different de celui tu as créeer serviceUser 
       $commercial = $cs->getCommercial()->withId($id)->executeOne();

         if(isset($_FILES['images']) && !$_FILES['images']['error'])  {
                $date = new \DateTime('NOW');
                $images = $date->format('Y-m-d-H-s').$_FILES['images']['name'];
               $commercial->addImage($images);

                $dirname= $this->getParameter('kernel.project_dir').'/photos/'; //Un dossiers
                move_uploaded_file($_FILES['images']['tmp_name'],$dirname.$images); 
                $db->save($commercial);
                return  $this->json(['ok'=>'ok'
                                   
                    ],200);
         }else{
               return $this->json(['error'=>'erreur',
                                   'images'=>$_FILES['images']
                    ],400);

         }

  }


 public function getCommercial(CommercialService $db,ManagerRegistry $m, $id) {
        $db->manager($m);

        $commmerce = $db->getCommercial()->withId($id)->executeOne();
        if($commmerce ===null){
            return $this->json([
             'error'=>"ID non valide"
            ]);
        }

        return $this->json($commmerce);
    }

     

  public function deleteCommerce(CommercialService $db, ManagerRegistry $m, $id) {
    try {
        $db->manager($m);

        $commerce = $db->getCommercial()->withId($id)->executeOne(); //La fonction getUsers est dans le fichier Dbservice

        if (!$commerce) {
            return $this->json(['error' => 'bien commercial introuvé non trouvé'], 404);
        }

        $db->delete($commerce);

        return $this->json(['message' => 'ok'], 200);
    }
    catch(\Exception $ex) {
        return $this->json([
            'message' => $ex->getMessage()
        ], 400);
    }
}

 public function updateCommercial(CommercialService $db,Request $request,ManagerRegistry $m,$id) {
         try{
              $db->manager($m);
             //On recupere l'id du user qu'on veut modifier
            $user = $db->getCommercial()->withId($id)->executeOne();
     
            if(count($request->request->all()) ===0){
                    $data = $request->toArray();
                                  
                    $status = $data['status'];
                    $prix= $data['prix'];
                    $rue = $data['rue'];
                    $npa = $data['npa'];
                    $type =$data['type'];
                    $canton = $data['canton'];
                    $ville =$data['ville'];
                  
            }else{  
    
                    $npa = $request->request->get('npa');
                    $prix = $request->request->get('prix');
                    $type = $request->request->get('type');
                    $status = $request->request->get('status');
                    $rue = $request->request->get('rue');
                    $canton = $request->request->get('canton');
                    $ville = $request->request->get('ville');  
            } 
                 
                $user->getCommercial()->setNpa($npa);
                $user->getCommercial()->setType($type);
                $user->getCommercial()->setPrix($prix);
                $user->getCommercial()->setStatus($status);
                $user->getCommercial()->setCanton($canton);
                $user->getCommercial()->setVille($ville);
                $user->getCommercial()->setRue($rue);
                $db->save($user);

        } catch(\Exception $ex) {
            return $this->json([
                'message'=> $ex->getMessage()
            ],401);
        }
       
  }
   


    
} 
  








