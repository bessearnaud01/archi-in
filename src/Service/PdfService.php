<?php


namespace App\Service;



class PdfService {

   protected $pdf;

   protected $data;

    public function getPdf()   {
        return $this->pdf;
    }
   
    public function setPdf($pdf): self
    {
        $this->pdf = $pdf;
        return $this;
    }


      public function getData()   {
        return $this->data;
    }
   
    public function setData($data): self
    {
        $this->data = $data;
        return $this;
    }
    



}