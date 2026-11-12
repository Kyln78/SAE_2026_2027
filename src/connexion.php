<?php
$titre = 'MBC – Accueil';
$page  = 'index';
include 'header.php';
?>

<main>
    <h2>Bienvenue !</h2>
    <p>Notre plateforme web a pour but de vous proposer différents modules interactifs, mêlant jeux, défis et énigmes. Conçu pour mettre vos capacités de réflexion et de déduction à l'épreuve, notre système vous invite à explorer une série d'épreuves mystérieuses.

        En tant que joueur inscrit, vous pourrez suivre votre progression sur la plateforme. Si un problème s'avère trop complexe, vous avez la possibilité de suspendre un défi commencé et de le reprendre plus tard à votre rythme.

        Que vous soyez un simple visiteur curieux ou un expert prêt à décrypter nos mystères, préparez-vous à faire chauffer vos neurones. Initialisez votre session, choisissez votre premier module et relevez le défi !
        .
    </p>
    <h1>Connexion</h1>

    <form action="/connexion" method="post">
        <fieldset>
            <legend>Se connecter à votre compte</legend>

            <label for="email">Email :</label><br>
            <input type="email" id="email" name="email"><br><br>

            <label for="password">Mot de passe :</label><br>
            <input type="password" id="password" name="password"><br><br>

            <label>
                <input type="checkbox" name="remember" value="1">
                Souvenez vous de moi ?
            </label><br><br>

            <button type="submit">Se connecter</button>
        </fieldset>
    </form>
</main>

<?php include 'footer.php'; ?>