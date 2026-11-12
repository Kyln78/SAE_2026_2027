<?php
$titre = $titre ?? 'MBC – Accueil';
$page  = $page ?? '';

$liens = [
        'index'     => 'Accueil',
        'module'    => 'Modules de jeu',
        'profil'    => 'Profil',
        'connexion' => 'Connexion',
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($titre) ?></title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<header>
    <h1>Mystery, Brain & Challenges</h1>
    <nav>
        <ul class="menu">
            <?php foreach ($liens as $id => $libelle):
                if ($id !== $page):?>
                    <li><a href="<?= $id ?>.php"><?= $libelle ?></a></li>
                <?php endif;
            endforeach; ?>
        </ul>
    </nav>
</header>