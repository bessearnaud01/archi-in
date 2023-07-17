<?php

namespace App\EventListener;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Event\LogoutEvent;


//On va ecrit dans le fichier  service.yaml va voir labas
class ApiLogoutListener{
             public function logout(LogoutEvent $e){
               $e->setResponse(new JsonResponse(['message'=>'logout']));
             }       
}