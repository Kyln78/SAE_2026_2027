<?php
$titre = 'MBC – Accueil';
$page  = 'profil';
include 'includes/header.php';
?>

<h1 style="font-size: 48px; text-align: center;">Profil utilisateur</h1>

<?php if (estConnecte()): ?>
    <p>Vous êtes connecté en tant que <strong><?= e($_SESSION['identifiant']) ?></strong>.</p>
    <p><a href="deconnexion.php">Se déconnecter</a></p>
<?php endif;?>
<?php if (!estConnecte()): ?>
    <a href="connexion.php" class="connexion">Se connecter ?</a>
<?php endif;?>

<?php include 'includes/footer.php'; ?>