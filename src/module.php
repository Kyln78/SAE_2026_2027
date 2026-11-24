<?php
$titre = 'MBC – Accueil';
$page  = 'module';
include 'includes/header.php';
?>

<h1 style="font-size: 48px; text-align: center;">Modules de jeux</h1>

<div class="cards">
    <article class="card">
        <header>
            <h2>Jeu 1</h2>
        </header>
        <img src="includes/Plan-Iut.png" alt="Jeu 1">
        <div class="content">
            <p>
                Jeu numéro 1 - Règles : Vous êtes enfermé dans l'IUT de Vélizy. Explorez le plan à la souris pour trouver les zones cachées et résolvez chaque énigme mathématique avant la fin du chrono pour débloquer la sortie !
            </p>
        </div>
        <a href="Règles/Regles1.php" class="mon-bouton">Règles du premier jeu</a>
        <a href="Jeux/Jeux1.php" class="mon-bouton2">Lien vers le premier jeu</a>
    </article>
</div>

<?php include 'includes/footer.php'; ?>