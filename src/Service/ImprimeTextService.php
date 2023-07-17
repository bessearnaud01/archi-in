<?php


namespace App\Service;
use App\Service\ImprimerService;
use DateTime;

class ImprimeTextService extends PdfService{

   public function Imprimer(){
   
   $this->pdf->SetTitle('Pdf information');
   $this->pdf->SetFont('helvetica', 'BI', 20);
   $this->pdf->AddPage();

   
   $this->pdf->Image(__DIR__.'/../../photos/ARCHI-IN.png',0,0,50,40);
   $this->pdf->Ln(10);
   $this->pdf->SetTextColor( 255, 87, 51 );
   $style=["width"=>.1,"cap"=>"butt","join"=>"miter","dash"=>0,"color"=>[255, 87, 51]];
   $this->pdf->SetLineStyle($style);
   $this->pdf->Cell(0,15," INFORMATION DE L'UTILISATEUR",1,1,'C');

   $this->pdf->Ln(20);
   $user= $this->data['user'];

   $this->pdf->SetTextColor(0,0,0);

   $photo= __DIR__.'/../../photos/'.$user->getAddress()->getAvatar();

   // $this->pdf->Cell(10,10,$photo);
    
   $this->pdf->Ln(60);

   $this->pdf->Image($photo,10,60,40,0,"JPG",false);
  
   $this->pdf->Ln(10);
   $this->pdf->SetFont('helvetica', 'BI', 14);
   $this->pdf->Cell(5,0,'Nom de l\' utilisateur : '.$user->getNom(),0,1); 
   $this->pdf->SetFont('helvetica', 'BI', 14);
  
   $this->pdf->Cell(10,0,'Prénom de l\' utilisateur : '.$user->getPrenom(),0,1);
   $this->pdf->Ln(10);

   $this->pdf->Cell(0, 5, 'Les informations de l\'agence', 0, 1, 'C');
   $this->pdf->Ln(10);
   $this->pdf->Cell(10,0,'Le Nom de l\'entreprise : '.$user->getAddress()->getEntreprise(),0,1);
  // $this->pdf->Cell(10,0,'Le numéro postale: '.$user->getAddress()->getDate_naissance( ),0,1);

   $this->pdf->Cell(10,0,'Le Numero postal de l\'entreprise : '.$user->getAddress()->getNpa(),0,1);
    $this->pdf->Cell(10,0,'La rue de l\'entreprise : '.$user->getAddress()->getRue(),0,1);
   $this->pdf->Cell(10,0,'La Ville de l\'entreprise : '.$user->getAddress()->getVille(),0,1);

  $this->pdf->Cell(10,0,'Le numéro de le téléphone de l\'entreprise : '.$user->getAddress()->getPhone(),0,1);


   }




   
 





}















?>
