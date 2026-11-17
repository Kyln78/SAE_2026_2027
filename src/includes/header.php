<?php
$titre = $titre ?? 'MBC – Accueil';
$page  = $page ?? 'index.php';
$racine = $racine ?? '';
$liens = [
        'index'     => ['libelle' => 'Accueil',        'url' => 'index.php'],
        'module'    => ['libelle' => 'Modules de jeu', 'url' => 'module.php'],
        'profil'    => ['libelle' => 'Profil',         'url' => 'profil.php'],
        'connexion' => ['libelle' => 'Connexion',      'url' => 'connexion.php'],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titre) ?></title>
    <link rel="stylesheet" href="<?= $racine ?>CSS/style.css">
</head>
<body>

<header>
    <h1>Mystery, Brain & Challenges</h1>
    <nav>
        <ul class="menu">
            <?php foreach ($liens as $id => $infos): ?>
                <li>
                    <!-- Les liens du menu s'adaptent aussi pour ne pas casser -->
                    <a href="<?= htmlspecialchars($racine . $infos['url']) ?>"
                       class="<?= ($id === $page) ? 'active' : '' ?>">
                        <?= htmlspecialchars($infos['libelle']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>