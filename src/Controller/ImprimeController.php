<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Service\ImprimerService;
use App\Service\ImprimeTextService;
use App\Service\UserService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

class ImprimeController extends AbstractController
{
    // Elle permet de récuperer les addresses
    public function ImprimeUser(UserService $db,ManagerRegistry $m, ImprimerService $pdf , ImprimeTextService $imprime, $id) {
        

try{

         $this->denyAccessUnlessGranted('ROLE_USER'); //Elle me permet personne puisse avoir accès à mes donnes sur le serveur

         $db->manager($m);
         $user = $db->getUser()->withId($id)->executeOne();
        if($user ===null){
            return $this->json([
             'error'=>"ID non valide"
            ],404);
        }
        $imprime->setPdf($pdf);
        $imprime->setData(['user'=>$user]);
        $imprime->Imprimer();
        return new Response(
                    $pdf->generatePdf("test.pdf"),
                    Response::HTTP_OK,
                    ['content-type'=>'application/pdf']
        );            

   } catch(\Exception $ex) {
            return $this->json([
                'message'=> $ex->getMessage()
            ],401);
        }
       
    }
     



     
} 
  








