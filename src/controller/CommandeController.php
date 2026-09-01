<?php

declare(strict_types=1);

namespace App\Http;

use App\Service\CommandeService;
use App\dto\CommandeDTO;
use Throwable;

final class CommandeController
{
    public function __construct(private CommandeService $commandeService)
    {
    }

    public function handle(string $method, array $post): void
    {
        $method = strtoupper($method);
        $values = [
            'prixFinal' => $post['prixFinal'] ?? '',
            'reductionAppliquee' => isset($post['reductionAppliquee']),
        ];

        if ($method === 'GET') {
            $this->render($values);
            return;
        }

        $prixFinal = (float) ($post['prixFinal'] ?? 0);

        if ($prixFinal <= 0) {
            $this->render($values, ['prixFinal' => 'Saisissez un prix valide supérieur à 0 €.'], null, 422);
            return;
        }

        try {
            $commandeId = $this->commandeService->enregistrerCommande(
                new CommandeDTO(
                    prixFinal: $prixFinal,
                    reductionAppliquee: $values['reductionAppliquee']
                )
            );
        } catch (Throwable $exception) {
            error_log($exception->getMessage());
            $this->render(
                $values,
                [],
                ['type' => 'error', 'message' => 'La commande n’a pas été enregistrée. Réessayez.'],
                500
            );
            return;
        }

        $this->render(
            ['prixFinal' => '', 'reductionAppliquee' => false],
            [],
            ['type' => 'success', 'message' => sprintf('Commande n°%d enregistrée.', $commandeId)],
            201
        );
    }

    private function render(array $values, array $errors = [], ?array $feedback = null, int $status = 200): void
    {
        http_response_code($status);
        require dirname(__DIR__) . '/view/commande.php';
    }
}
