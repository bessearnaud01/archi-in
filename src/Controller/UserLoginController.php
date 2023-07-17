<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use App\Entity\BaseEntity;
use Symfony\Component\HttpFoundation\Response;

class UserLoginController extends AbstractController
{



    public function login() {
  
    try{


      if($this->getuser() ===null){ //getuser récupère l'id et n'est pas on le retourne le message 'message'=>'missing credentials'
        
        return $this->json([
               'message'=>'missing credentials',
        ],Response:: HTTP_UNAUTHORIZED);

      }
      /** @var User $user */
      $user = $this->getUser();
     
       return $this->json([ // Si l'utilisateur existe on le recupere le mail et son mot de passe
                'user' =>$user->getUserIdentifier(),     // getUserIdentifier elle retourne le mail  
                'idUser' =>$user->getId(), //Elle represente l'id de user qui va nous le recupere l'id d'user
                'nom' => $user->getNom(),
                'prenom' =>$user->getPrenom(),
                'avatar' =>$user->getAvatar()
         ]);  

   } catch(\Exception $ex) {
            return $this->json([
                'message'=> $ex->getMessage()
            ],401);
        }



}



//Elle permet de verifier si le user est existe
public function check(): Response{
  
  $this->denyAccessUnlessGranted('ROLE_USER'); //Elle me permet personne puisse avoir accès à mes donnes sur le serveur
   /** @var User $user */
      $user = $this->getUser();
    return $this->json([
               'user' =>$user->getUserIdentifier(),     // getUserIdentifier elle retourne le mail  
                'idUser' =>$user->getId(), //Elle represente l'id de user qui va nous le recupere l'id d'user
                'nom' => $user->getNom(),
                'prenom' =>$user->getPrenom(),
                'avatar' =>$user->getAvatar()


  ],200);
   }

}











