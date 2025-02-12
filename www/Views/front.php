<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? "Titre de page" ?></title>
    <meta name="description" content="<?= $description ?? "ceci est la description de ma page" ?>">
    <link rel="stylesheet" href="/www/Public/assets/css/main.css">
</head>
<body>
<header>
    <h1><?= $titlePage ?? "Title page" ?></h1>
</header>
<main class="container">
    <?php include "../Views/" . $this->v; ?>
</main>
</body>
</html>