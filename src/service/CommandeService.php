<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Commande;
use App\Model\CommandeRepository;
use App\dto\CommandeDTO;
use DateTimeImmutable;

final class CommandeService
{
    private const TAUX_REDUCTION = 0.10;

    public function __construct(private CommandeRepository $commandeRepository)
    {
    }

    public function enregistrerCommande(CommandeDTO $commandeDTO): int
    {
        $reductionAppliquee = $commandeDTO->reductionAppliquee;
        $prixFinal = $commandeDTO->prixFinal;

        if ($reductionAppliquee) {
            $prixFinal = round($prixFinal * (1 - self::TAUX_REDUCTION), 2);
        }

        $commande = new Commande(
            0,
            new DateTimeImmutable(),
            $prixFinal,
            $reductionAppliquee
        );

        return $this->commandeRepository->saveCommande($commande);
    }
}
