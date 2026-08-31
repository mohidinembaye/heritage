<?php


namespace App\Entity;


class Commande extends AbstractEntity
{
    private float $prixFinal;

    private bool $reductionAppliquee;
  public function __construct(int $id,DateTime $dateCreation, float $prixFinal) {
        parent::__construct($id, $dateCreation);  
        $this->prixFinal = $prixFinal; 
        $this->reductionAppliquee=$reductionAppliquee;           
    }


  public function setPrixFinal(float $prixFinal):void{
      $this->prixFinal= $prixFinal;

  }
  public function getPrixFinal(){
        return $this->prixFinal;

  }

  public function setReductionAppliquee(bool $reductionAppliquee){
         $this->reductionAppliquee= $reductionAppliquee;
;

  }
  public function getReductionAppliquee(){
    return $this->reductionAppliquee;

  }
}
