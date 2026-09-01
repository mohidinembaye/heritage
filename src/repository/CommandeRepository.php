<?php
namespace App\Model;

use App\Core\Database;
use App\Entity\Commande;

class CommandeRepository
{
    public function saveCommande(Commande $commande): int
    {
        $connexion = Database::getConnexion();
        $sql = "INSERT INTO commande (prix_final, reduction_appliquee, date_creation)
                VALUES (:prix_final, :reduction_appliquee, :date_creation)";
        $prepare = $connexion->prepare($sql);
        $prepare->execute([
            'prix_final' => $commande->getPrixFinal(),
            'reduction_appliquee' => $commande->getReductionAppliquee() ? 'true' : 'false',
            'date_creation' => $commande->getDateCreation()->format('Y-m-d'),
        ]);
        return (int) $connexion->lastInsertId();
    }
}