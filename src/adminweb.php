<?php
require 'includes/auth.php';

if (!estConnecte() || $_SESSION['role'] !== 'adminweb') {
    header('Location: connexion.php');
    exit;
}

$titre = 'MBC – Admin web';
$page  = '';
include 'includes/header.php';
?>

<main>
    <h2>Espace administrateur web</h2>
    <p>Bonjour <strong><?= e($_SESSION['identifiant']) ?></strong>, vous êtes connecté en tant qu'administrateur web.</p>
    <p><a href="deconnexion.php">Se déconnecter</a></p>
</main>

<?php include 'includes/footer.php'; ?>
