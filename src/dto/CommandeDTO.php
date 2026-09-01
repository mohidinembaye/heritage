<?php

declare(strict_types=1);

namespace App\dto;

final class CommandeDTO
{
    public function __construct(
        public float $prixFinal,
        public bool $reductionAppliquee
    ) {
    }
}
