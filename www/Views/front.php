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
    <h1><?= $titlePage ?? "Title page" ?></h1>
</header>
<main class="container">
    <?php include "../Views/" . $this->v; ?>
</main>
</body>
</html>