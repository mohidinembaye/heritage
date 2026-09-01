<?php


namespace App\Entity;


class Commande extends AbstractEntity
{
    private float $prixFinal;

    private bool $reductionAppliquee;
  public function __construct(int $id, \DateTimeImmutable $dateCreation, float $prixFinal, bool $reductionAppliquee = false) {
        parent::__construct($id, $dateCreation);
        $this->prixFinal = $prixFinal;
        $this->reductionAppliquee = $reductionAppliquee;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getDateCreation(): \DateTimeImmutable {
        return $this->dateCreation;
    }


  public function setPrixFinal(float $prixFinal): void
  {
      $this->prixFinal = $prixFinal;
  }

  public function getPrixFinal(): float
  {
      return $this->prixFinal;
  }

  public function setReductionAppliquee(bool $reductionAppliquee): void
  {
      $this->reductionAppliquee = $reductionAppliquee;
  }

  public function getReductionAppliquee(): bool
  {
      return $this->reductionAppliquee;
  }
}
