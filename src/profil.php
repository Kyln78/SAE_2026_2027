<?php
require 'includes/auth.php';

if (!estConnecte()){
    header('Location: connexion.php');
    exit;
}
$titre = 'MBC – Accueil';
$page  = 'profil';
include 'includes/header.php';
?>

<h1 style="font-size: 48px; text-align: center;">Profil utilisateur</h1>

<?php if ($_SESSION['role'] === 'adminweb'): ?>
    <h2 class ="head-card">Espace administrateur web</h2>
    <p class ="body-card">Bonjour <strong><?= e($_SESSION['identifiant']) ?></strong>, vous êtes connecté en tant qu'administrateur web.</p>
    <p class = "footer-card"><a href="deconnexion.php">Se déconnecter</a></p>
<?php endif;?>
<?php if ($_SESSION['role'] === 'adminsys'): ?>
    <h2 class ="head-card">Espace administrateur système</h2>
    <p class ="body-card">Bonjour <strong><?= e($_SESSION['identifiant']) ?></strong>, vous êtes connecté en tant qu'administrateur système.</p>
    <p class = "footer-card"><a href="deconnexion.php">Se déconnecter</a></p>
<?php endif;?>
<?php if ($_SESSION['role'] !== 'adminweb' && $_SESSION['role'] !== 'adminsys'): ?>
    <h2 class ="head-card">Esapce utilisateur</h2>
    <p class ="body-card">Bonjour <strong><?= e($_SESSION['identifiant']) ?></strong>, vous êtes connecté</p>
    <p class = "footer-card"><a href="deconnexion.php">Se déconnecter</a></p>
<?php endif;?>
<?php include 'includes/footer.php'; ?>