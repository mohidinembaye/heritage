<?php

declare(strict_types=1);

use App\Http\CommandeController;
use App\Model\CommandeRepository;
use App\Service\CommandeService;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$commandeRepository = new CommandeRepository();
$commandeService = new CommandeService($commandeRepository);
$commandeController = new CommandeController($commandeService);

$commandeController->handle(
    $_SERVER['REQUEST_METHOD'] ?? 'GET',
    $_POST
);
