<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\dto\CommandeDTO;
use App\Entity\Commande;
use App\Model\CommandeRepository;
use App\Core\Database;

$dto = new CommandeDTO(
    prixFinal: 15000.0,
    reductionAppliquee: true
);

$commande = new Commande(0, new \DateTimeImmutable(), $dto->prixFinal, $dto->reductionAppliquee);


$repository = new CommandeRepository();
$id = $repository->saveCommande($commande);
echo "Commande enregistrée avec l'id : $id\n";


