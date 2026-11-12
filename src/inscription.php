<?php
require 'includes/auth.php';
require 'includes/db.php';

if (estConnecte()) {
    header('Location: index.php');
    exit;
}

$titre = 'MBC – Inscription';
$page  = 'connexion';

$erreur = '';
$identifiant = trim($_GET['identifiant'] ?? ''); // Récupère l'identifiant depuis l'URL si disponible, sinon une chaîne vide

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifiant = trim($_POST['identifiant'] ?? '');
    $mdp         = $_POST['password'] ?? '';
    $mdp2        = $_POST['password2'] ?? '';

    if ($identifiant === '' || $mdp === '') {
        $erreur = 'Veuillez remplir tous les champs.';
    } elseif ($mdp !== $mdp2) {
        $erreur = 'Les mots de passe ne correspondent pas.';
    } else {
        $connexion = connecter();
        if (!$connexion) {
            $erreur = 'Erreur de connexion à la base de données.';
        } elseif (trouverUtilisateur($connexion, $identifiant)) {
            $erreur = 'Cet identifiant est déjà utilisé.';
            deconnecter($connexion);
        } else {
            $id = creerUtilisateur($connexion, $identifiant, $mdp);
            deconnecter($connexion);

            if ($id === false) {
                $erreur = "Erreur lors de la création du compte.";
            } else {
                connecterUtilisateur((int) $id, $identifiant, true);
                header('Location: index.php');
                exit;
            }
        }
    }
}

include 'header.php';
?>

<main>
    <h1>Créer un compte</h1>

    <?php if ($erreur): ?>
        <p class="erreur" style="color:#c0392b;"><?= e($erreur) ?></p>
    <?php endif; ?>

    <form action="inscription.php" method="post">
        <fieldset>
            <legend>Nouveau compte</legend>

            <label for="identifiant">Identifiant :</label><br>
            <input type="text" id="identifiant" name="identifiant" value="<?= e($identifiant) ?>" maxlength="50" required><br><br>

            <label for="password">Mot de passe :</label><br>
            <input type="password" id="password" name="password" minlength="6" required><br><br>

            <label for="password2">Confirmer le mot de passe :</label><br>
            <input type="password" id="password2" name="password2" minlength="6" required><br><br>

            <button type="submit">Créer mon compte</button>
        </fieldset>
    </form>

    <p>Déjà inscrit ? <a href="connexion.php">Se connecter</a></p>
</main>

<?php include 'footer.php'; ?>
