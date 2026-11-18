<?php
$tempsMax = 30;

$enigmes = [
    1 => ['lieu' => 'BA1 – Garros',        'question' => 'Résoudre t² − t = 12.',              'reponse' => [4, -3], 'aide' => 'Il y a deux solutions (séparez-les par un point-virgule).'],
    2 => ['lieu' => 'BA2 – Boucher',       'question' => 'Résoudre 3x + 7 = 25.',              'reponse' => [6],     'aide' => ''],
    3 => ['lieu' => 'BA3 – Bastie',        'question' => 'Résoudre x² − 5x + 6 = 0.',          'reponse' => [2, 3],  'aide' => 'Il y a deux solutions (séparez-les par un point-virgule).'],
    4 => ['lieu' => 'BA4 – St Exupéry',    'question' => 'Soit f(x) = x³. Calculer f\'(2).',   'reponse' => [12],    'aide' => ''],
    5 => ['lieu' => 'BA5 – Mermoz',        'question' => 'Résoudre 2ˣ = 64.',                  'reponse' => [6],     'aide' => ''],
    6 => ['lieu' => 'BA6 – Blériot',       'question' => 'Calculer 1 + 2 + 3 + … + 10.',       'reponse' => [55],    'aide' => ''],
    7 => ['lieu' => 'BA7 – Ancienne loge', 'question' => 'Résoudre x² = 49.',                  'reponse' => [7, -7], 'aide' => 'Il y a deux solutions (séparez-les par un point-virgule).'],
    8 => ['lieu' => 'BA8 – Modulaires',    'question' => 'Calculer 15 % de 240.',              'reponse' => [36],    'aide' => ''],
];

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$e = $enigmes[$id] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Énigme</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body class="enigme">
<?php if ($e === null): ?>
    <div class="titreenigme">
        <h3 class="titreenigme">Bienvenue à l'IUT de Vélizy…</h3>
    </div>    
    <div class="texteenigme">
        <p class="texteenigme">La porte vient de se refermer derrière vous. Pour sortir, il faut résoudre toutes les énigmes cachées dans les bâtiments.</p>
        <p class="texteenigme">Cherchez avec la souris une zone cliquable sur le plan, puis répondez en 30 secondes !</p>
    </div>
<?php else: ?>
    <div class="enigme-lieu"><?= htmlspecialchars($e['lieu']) ?></div>
    <div class="enigme-question"><?= htmlspecialchars($e['question']) ?></div>
    <?php if ($e['aide'] !== ''): ?>
        <div class="enigme-aide"><?= htmlspecialchars($e['aide']) ?></div>
    <?php endif; ?>

    <div class="enigme-temps" id="blocTemps">Temps restant : <span id="chrono"><?= $tempsMax ?></span> s</div>
    <div class="enigme-barre"><span id="barre"></span></div>

    <form id="formulaire" class="enigme-form" autocomplete="off">
        <input type="text" id="reponse" placeholder="Votre réponse" autofocus>
        <button type="submit" id="valider">Valider</button>
    </form>
    <div id="message" class="enigme-message"></div>

    <script>
        const ID = <?= $id ?>;
        const REPONSES = <?= json_encode($e['reponse']) ?>;
        const MAX = <?= $tempsMax ?>;
        let reste = MAX;
        let fini = false;

        const chrono = document.getElementById('chrono');
        const blocTemps = document.getElementById('blocTemps');
        const barre = document.getElementById('barre');
        const message = document.getElementById('message');
        const champ = document.getElementById('reponse');

        const interval = setInterval(function () {
            reste--;
            chrono.textContent = reste;
            barre.style.width = (reste / MAX * 100) + '%';
            if (reste <= 10) {
                blocTemps.classList.add('urgent');
                barre.classList.add('urgent');
            }
            if (reste <= 0) {
                terminer(false);
            }
        }, 1000);

        function terminer(succes) {
            if (fini) return;
            fini = true;
            clearInterval(interval);
            champ.disabled = true;
            document.getElementById('valider').disabled = true;
            if (succes) {
                message.className = 'enigme-message ok';
                message.textContent = 'Bonne réponse';
                try { window.parent.enigmeResolue(ID); } catch (err) {}
            } else {
                chrono.textContent = 0;
                message.className = 'enigme-message ko';
                message.textContent = 'Temps écoulé';
                try { window.parent.enigmeEchec(ID); } catch (err) {}
            }
        }

        function lireNombres(texte) {
            texte = texte.replace(/\u2212/g, '-');          
            const trouves = texte.match(/-?\d+(?:\.\d+)?/g) || [];
            return trouves.map(Number).sort(function (a, b) { return a - b; });
        }

        document.getElementById('formulaire').addEventListener('submit', function (ev) {
            ev.preventDefault();
            if (fini) return;
            const saisie = lireNombres(champ.value);
            const attendu = REPONSES.slice().sort(function (a, b) { return a - b; });
            const bon = saisie.length === attendu.length &&
                        saisie.every(function (v, i) { return v === attendu[i]; });
            if (bon) {
                terminer(true);
            } else {
                message.className = 'enigme-message ko';
                message.textContent = 'Mauvaise réponse, réessayez !';
                champ.select();
            }
        });
    </script>
<?php endif; ?>
</body>
</html>
