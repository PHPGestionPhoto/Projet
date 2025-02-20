<?php

use App\Core\User as U;

$user = new U;
?>
<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? "Titre de page" ?></title>
    <meta name="description" content="<?= $description ?? "ceci est la description de ma page" ?>">
    <link rel="stylesheet" href="/Public/assets/css/main.css">
</head>
<body class="<?= basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '.php') ?: 'home'; ?>">
<header>
    <header class="custom-header">

    <nav class="nav-links">
        <ul>
            <li><a href="/">Accueil</a></li>
           <?php if ($user->isLogged()): ?>
            <li><a href="/feed">Feed</a></li>
            <li><a href="/logout">Déconnexion</a></li>
            <?php else: ?>
            <li><a href="/login">Connexion</a></li>
            <li><a href="/register">Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
</header>
<main class="container">
    <?php include "../Views/" . $this->v; ?>
</main>
</body>
</html>