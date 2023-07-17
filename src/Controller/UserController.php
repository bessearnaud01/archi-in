<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Commercial;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use App\Service\CommercialService;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Service\UserService;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\Existence;
use Symfony\Flex\Command\UpdateRecipesCommand;

class UserController extends AbstractController
{
    // Elle permet de récuperer les addresses
    public function users(UserService $db,ManagerRegistry $m) {
        $db->manager($m);

        $users = $db->getUser()->execute();
 
       
        return $this->json($users);
    }
      //Elle permet de recuperer la fonction address  serait dans le fichier user.js

    public function user(UserService $db,ManagerRegistry $m, $id) {
        $db->manager($m);

        $user = $db->getUser()->withId($id)->executeOne();
        if($user ===null){
            return $this->json([
             'error'=>"ID non valide"
            ]);
        }
 
        return $this->json($user);
    }

   // fonction qui permet d'ajouter un user

    public function addUser(UserService $db,Request $request,ManagerRegistry $m, UserPasswordHasherInterface  $passwordHasher) {
        $db->manager($m);
        $user = new User();
        try{
                if(count($request->request->all()) ===0){
                    $data = $request->toArray();
                   
                    $nom =$data['nom'];
                    $prenom = $data['prenom'];
                    $mail = $data['mail'];
                    $motdepasse = $data['motdepasse'];
               
        
                }else{
                    
                    $nom = $request->request->get('nom');
                    $prenom = $request->request->get('prenom');
                    $mail = $request->request->get('mail');
                    $motdepasse = $request->request->get('motdepasse');

                    
                }
                $user->setNom($nom);
                $user->setPrenom($prenom);
                $user->setMail($mail);
                $user->setPassword($motdepasse);
                
                $hashedPassword = $passwordHasher->hashPassword($user,$motdepasse);

                $user->setPassword($hashedPassword);

                $db->save($user);

                return $this->json(['message'=>'ok'],200);

        } catch(\Exception $ex) {
            return $this->json([
                'message'=> $ex->getMessage()
            ],401);
        }   
    
    } 


 public function updateUser(UserService $db,Request $request,ManagerRegistry $m, $id  ) {

        $db->manager($m);
        //On recupere l'id du user qu'on veut modifier
        $user = $db->getUser()->withId($id)->executeOne();
        
        if(! $user ){  
           return $this->json(['error'=>' user non retrouvé'], 404);
        }
        
 
        try{
            if(isset($_FILES['avatar']) && !$_FILES['avatar']['error'])  {
                $date = new \DateTime('NOW');
                $avatar= $date->format('Y-m-H').$_FILES['avatar']['name'];
                $user->setAvatar($avatar);
                $dirname= $this->getParameter('kernel.project_dir').'/photos/';
                move_uploaded_file($_FILES['avatar']['tmp_name'],$dirname.$avatar);  
           }

            if(count($request->request->all()) ===0){
                $data = $request->toArray();
                    $nom =$data['nom'];
                    $prenom = $data['prenom'];
                   // $mail = $data['mail'];
                  //  $motdepasse = $data['motdepasse'];
                    $npa = $data['npa'];
                    $entreprise = $data['entreprise'];
                    $phone = $data['phone'];
                    $rue =$data['rue'];
                    $date_naissance = $data['date_naissance'];
                    $ville =$data['ville'];
          
            }else{
                    $nom = $request->request->get('nom');
                    $prenom = $request->request->get('prenom');
                 //   $mail = $request->request->get('mail'); 
                  //  $motdepasse = $request->request->get('motdepasse');
                    $npa = $request->request->get('npa');
                    $ville = $request->request->get('ville');
                    $date_naissance = $request->request->get('date_naissance');
                    $rue = $request->request->get('rue');
                    $phone = $request->request->get('phone');
                    $entreprise = $request->request->get('entreprise');

                
            }
              
                $user->setNom($nom);
                $user->setPrenom($prenom);
                $address= new Address();
               // $user->setMail($mail);
               // $user->setPassword($motdepasse);
                $address->setVille($ville); //Je recupere ds l'entité address et je peux le modifier
                $address->setNpa($npa);
                $address->setPhone($phone);
                $address->setRue($rue);
                $address->setEntreprise($entreprise);
                $address->setDate_naissance( new \DateTime($date_naissance));
             //   $hashedPassword = $passwordHasher->hashPassword($user);
              //  $user->setPassword($hashedPassword);
                $user->setAddress($address);
                $db->save($user);
           
              
            return $this->json(['message'=>'ok'],200);

    } catch(\Exception $ex) {
        return $this->json([
            'message'=> $ex->getMessage()
        ],401);
    }


  }


//C'est la fonction met permet d'affiche mon image pour adresse
 public function avatar($img){
  $path = $this->getParameter('kernel.project_dir') . '/photos/';
  $filename = $path.$img;

   if(file_exists($filename)){
     return new BinaryFileResponse($filename);

     }else{
         return new BinaryFileResponse($path.'avatar.jpg');
     }
  }
   //On recupere l'id d'user
     public function addCommercial(UserService $db,Request $request,ManagerRegistry $m) {
         try{
            
        $db->manager($m);
        /** @var User */
       $user = $this->getUser();//getUser est une fonction symfony qui permet de recuperer l'utlisateur elle est different de celui tu as créeer serviceUser 
        $commercial = new Commercial();
        $db->manager($m);
     
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
                    $type = $request->request->get('type');
                    $status = $request->request->get('status');
                    $rue = $request->request->get('rue');
                    $canton = $request->request->get('canton');
                    $ville = $request->request->get('ville');  
            }
                
                $commercial->setNpa($npa);
                $commercial->setType($type);
                $commercial->setStatus($status);
                $commercial->setCanton($canton);
                $commercial->setPrix($prix);
                $commercial->setRue($rue);
                $commercial->setVille($ville);
                $user->addCommercial($commercial);
                $db->save($user);
                
                return $this->json(['id'=>$commercial->getId()],200);
                //Elle permet de recupere l'id dans le formulaire image

        } catch(\Exception $ex) {
            return $this->json([
                'message'=> $ex->getMessage()
            ],401);
        }
       
  }
//On ajoute les images commercial

  public function ajouterImage(UserService $db,ManagerRegistry $m, CommercialService $cs,$id) {
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







} 
  








