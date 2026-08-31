<?php

declare(strict_types=1);

use App\Model\CommandeRepository;
use App\Service\CommandeService;
use App\dto\CommandeDTO;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dto = new CommandeDTO(
    prixFinal: 15000.0,
    reductionAppliquee: true
);

$commandeRepository = new CommandeRepository();
$commandeService = new CommandeService($commandeRepository);
$id = $commandeService->enregistrerCommande($dto);

echo "Commande enregistrée avec l'id : $id\n";
