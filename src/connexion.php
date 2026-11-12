<?php
require 'includes/auth.php';
require 'includes/db.php';

$titre = 'MBC – Connexion';
$page  = 'connexion';

$erreur = '';
$compteInexistant = false;
$identifiant = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !estConnecte()) {
    $identifiant = trim($_POST['identifiant'] ?? ''); // Récupère l'identifiant saisi par l'utilisateur, ou une chaîne vide si le champ est vide
    $mdp         = $_POST['password'] ?? '';
    $souvenir    = isset($_POST['remember']); // Vérifie si l'utilisateur a coché la case "Se souvenir de moi"

    if ($identifiant === '' || $mdp === '') {
        $erreur = 'Veuillez remplir tous les champs.';
    } else {
        $connexion = connecter();
        if (!$connexion) {
            $erreur = 'Erreur de connexion à la base de données.';
        } else {
            $user = trouverUtilisateur($connexion, $identifiant); // Recherche l'utilisateur dans la base de données
            deconnecter($connexion);

            if (!$user) {
                $compteInexistant = true;
            } elseif (!password_verify($mdp, $user['password']) && $mdp !== $user['password']) { // Vérifie si le mot de passe saisi correspond au mot de passe haché stocké dans la base de données
                $erreur = 'Mot de passe incorrect.';
            } else {
                connecterUtilisateur((int) $user['id'], $identifiant, $user['role'], $souvenir); // Connecte l'utilisateur en stockant son ID et son identifiant dans la session, et prolonge la durée de vie du cookie si nécessaire
                header('Location: ' . pageRole($user['role']));
                exit;
            }
        }
    }
}

include 'includes/header.php';
?>

<main>
    <h1>Connexion</h1>

    <?php if (estConnecte()): ?>
        <p>Vous êtes connecté en tant que <strong><?= e($_SESSION['identifiant']) ?></strong>.</p>
        <p><a href="deconnexion.php">Se déconnecter</a></p>
    <?php else: ?>

    <?php if ($erreur): ?>
        <p class="erreur" style="color:#c0392b;"><?= e($erreur) ?></p>
    <?php endif; ?>

    <?php if ($compteInexistant): ?>
        <p class="erreur" style="color:#c0392b;">
            Aucun compte n'existe avec l'identifiant <?= e($identifiant) ?>.
                <a href="inscription.php?identifiant=<?= urlencode($identifiant) ?>">Créer un compte</a>
            </p>
        <?php endif; ?>

        <form action="connexion.php" method="post">
            <fieldset>
                <legend>Se connecter à votre compte</legend>

                <label for="identifiant">Identifiant :</label><br>
                <input type="text" id="identifiant" name="identifiant" value="<?= e($identifiant) ?>" required><br><br>

                <label for="password">Mot de passe :</label><br>
                <input type="password" id="password" name="password" required><br><br>

                <label>
                    <input type="checkbox" name="remember" value="1" checked>
                    Souvenez-vous de moi ?
                </label><br><br>

                <button type="submit">Se connecter</button>
            </fieldset>
        </form>

        <p>Pas encore de compte ? <a href="inscription.php">Créer un compte</a></p>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>
