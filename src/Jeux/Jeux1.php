
<?php
$titre = 'MBC – Accueil';
$page = 'index';
$racine = '../';
include '../includes/header.php';
?>

<main>
    <h2 class="center big">Jeux 1</h2>

    <div class="centre">
        <button id="monBouton" onclick="debutJeu()" class="debutJeu" style="display: block;">
            Commencer le jeu
        </button>
    </div>
</main>
<div class ="centre">
    <img src="../includes/Plan-Iut.png" id="monImage" alt="Plan de l'IUT" style="width: 1200px; height: 800px; display: none;">
</div>
<script>
    function debutJeu() {
        const image = document.getElementById('monImage');
        const button = document.getElementById('monBouton')
        button.style.display = 'none'
        if (image.style.display === 'none' || image.style.display === '') {
            image.style.display = 'block';
        }
    }
</script>

<?php include '../includes/footer.php'; ?>
