<?php
require 'includes/auth.php';

if (!estConnecte() || $_SESSION['role'] !== 'user') {
    header('Location: connexion.php');
    exit;
}

$titre = 'MBC – Mon espace';
$page  = '';
include 'includes/header.php';
?>

<main>
    <h2>Espace utilisateur</h2>
    <p>Bonjour <strong><?= e($_SESSION['identifiant']) ?></strong>, bienvenue sur votre espace.</p>
    <p><a href="deconnexion.php">Se déconnecter</a></p>
</main>

<?php include 'includes/footer.php'; ?>
