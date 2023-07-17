<?php 


namespace App\Service;
use TCPDF;

class ImprimerService extends \TCPDF{

   public function Header(){
    $this->SetMargins(10,20);
    
   }
   

   public function Footer()
   {
     $this->SetY(-12);
     $this->SetFont('helvetica', 'BI', 12);
     $this->Cell(0,15,"Information utilisateur",0,0,'C');
   }
   public function GeneratePDF($fileName,$type='I'){
    $this->Output($fileName,$type); // I fichier envoie le fichier ds le navigateur et f envoie sauve ds un fichier sur le serveur

   }
 





}













?>