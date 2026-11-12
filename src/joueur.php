<?php
require_once 'includes/auth.php';
exigerRole('user'); // Réservé aux utilisateurs inscrits (rôle 'user')

$titre = 'MBC – Espace joueur';
$page  = 'espace';
include 'includes/header.php';
?>

<main>
    <h2>Espace joueur</h2>
    <p>Bienvenue <strong><?= e($_SESSION['identifiant']) ?></strong> ! Votre inscription a bien été prise en compte.</p>
    <p>Depuis cet espace, vous pourrez suivre votre progression, suspendre un défi et le reprendre plus tard.</p>
    <ul>
        <li><a href="module.php">Découvrir les modules de jeu</a></li>
        <li><a href="profil.php">Voir les profils</a></li>
    </ul>
    <p><a class="btn" href="deconnexion.php">Se déconnecter</a></p>
</main>

<?php include 'includes/footer.php'; ?>
