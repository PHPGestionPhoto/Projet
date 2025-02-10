<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\PageController;

// Récupère la page demandée (par défaut "home")
$page = $_GET['page'] ?? 'home';

$controller = new PageController();
$controller->show($page);
