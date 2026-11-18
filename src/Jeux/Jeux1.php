<?php
$titre = 'MBC – Accueil';
$page = 'index';
$racine = '../';
include '../includes/header.php';
?>

<link rel="stylesheet" href="../CSS/style.css">

<main class="jeu">
    <h2 class="jeu-titre">Jeux 1 – Échappez-vous de l'IUT !</h2>

    <section class="jeu-intro">
        <p>
            Vous venez d'entrer à l'IUT de Vélizy, mais la porte s'est refermée derrière vous.
            Pour en sortir, trouvez les 8 bâtiments du plan et résolvez l'énigme
            cachée dans chacun (30 secondes par énigme).
            Cherchez bien avec la souris !
        </p>
    </section>

    <button id="monBouton" onclick="debutJeu()" class="jeu-bouton">Commencer le jeu</button>

    <div class="jeu-stats">
        <div class="jeu-stat">Temps : <span id="timer">0</span> s</div>
        <div class="jeu-stat">Énigmes : <span id="score">0</span> / <span id="total">8</span></div>
    </div>

    <p id="messageFin" class="jeu-fin"></p>

    <div id="zoneJeu" style="display: none;">
        <div id="plan" class="jeu-plan">
            <img src="../includes/Plan-Iut.png" id="monImage" alt="Plan de l'IUT" usemap="#planIut">

            <map name="planIut" id="planIut">
                <area shape="rect"   data-id="1" data-coords="240,40,350,255"  href="enigme.php?id=1" target="cadre" alt="BA1 Garros">
                <area shape="rect"   data-id="2" data-coords="232,255,360,320" href="enigme.php?id=2" target="cadre" alt="BA2 Boucher">
                <area shape="rect"   data-id="3" data-coords="360,90,725,290"  href="enigme.php?id=3" target="cadre" alt="BA3 Bastie">
                <area shape="rect"   data-id="4" data-coords="75,380,225,460"  href="enigme.php?id=4" target="cadre" alt="BA4 St Exupéry">
                <area shape="rect"   data-id="5" data-coords="480,340,650,435" href="enigme.php?id=5" target="cadre" alt="BA5 Mermoz">
                <area shape="circle" data-id="6" data-coords="415,415,58"      href="enigme.php?id=6" target="cadre" alt="BA6 Blériot">
                <area shape="rect"   data-id="7" data-coords="535,530,705,560" href="enigme.php?id=7" target="cadre" alt="BA7 Ancienne loge du gardien">
                <area shape="rect"   data-id="8" data-coords="232,490,345,560" href="enigme.php?id=8" target="cadre" alt="BA8 Modulaires">
            </map>
        </div>
        <div class="centre">
            <iframe name="cadre" id="cadre" class="jeu-cadre" src="enigme.php" title="Énigme"></iframe>
        </div>
    </div>
</main>

<script>
    const Taille = 880, Hauteur = 590;  
    const TOTAL = document.querySelectorAll('#planIut area').length;

    let startTime = null;
    let timerInterval = null;
    let jeuTermine = false;
    const resolues = new Set();
    const marqueurs = [];           

    document.getElementById('total').textContent = TOTAL;

    function debutJeu() {
        document.getElementById('monBouton').style.display = 'none';
        document.getElementById('zoneJeu').style.display = 'block';
        ajusterZones();

        startTime = Date.now();
        clearInterval(timerInterval); 
        document.getElementById('timer').textContent = 0;

        timerInterval = setInterval(function () {
            const t = Math.floor((Date.now() - startTime) / 1000);
            document.getElementById('timer').textContent = t;
        }, 1000); 
    }

    function finJeu() {
        jeuTermine = true;
        clearInterval(timerInterval);
        const t = Math.floor((Date.now() - startTime) / 1000);
        document.getElementById('timer').textContent = t;
        const fin = document.getElementById('messageFin');
        fin.textContent = "Bravo ! Toutes les énigmes sont résolues, vous êtes sorti de l'IUT en " + t + " secondes !";
        fin.classList.add('visible');
        fin.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function enigmeResolue(id) {
        if (resolues.has(id) || jeuTermine) return;
        resolues.add(id);
        document.getElementById('score').textContent = resolues.size;
        ajouterMarqueur(id);
        if (resolues.size === TOTAL) finJeu();
    }

    function enigmeEchec(id) {
        if (jeuTermine) return;
        jeuTermine = true;
        clearInterval(timerInterval);
        document.getElementById('zoneJeu').style.display = 'none';
        const fin = document.getElementById('messageFin');
        fin.textContent = "Perdu ! Temps écoulé sur l'énigme " + id + ", vous restez enfermé à l'IUT…";
        fin.classList.add('visible');
        document.getElementById('monBouton').textContent = 'Rejouer';
        document.getElementById('monBouton').style.display = 'inline-block';
        document.getElementById('monBouton').onclick = function () { location.reload(); };
    }
        document.querySelectorAll('#planIut area').forEach(function (a) {
            a.addEventListener('click', function (e) {
                if (resolues.has(Number(a.dataset.id))) {
                    e.preventDefault();
                }
            });
        });

    function centreZone(area) {
        const c = area.dataset.coords.split(',').map(Number);
        if (area.shape === 'circle') return { x: c[0], y: c[1] };
        return { x: (c[0] + c[2]) / 2, y: (c[1] + c[3]) / 2 };
    }

    function ajouterMarqueur(id) {
        const area = document.querySelector('#planIut area[data-id="' + id + '"]');
        const c = centreZone(area);
        const el = document.createElement('div');
        el.className = 'jeu-marqueur';
        el.textContent = '✔';
        document.getElementById('plan').appendChild(el);
        marqueurs.push({ el: el, x: c.x, y: c.y });
        placerMarqueurs();
    }

    function placerMarqueurs() {
        const img = document.getElementById('monImage');
        const kx = img.clientWidth / Taille, ky = img.clientHeight / Hauteur;
        marqueurs.forEach(function (m) {
            m.el.style.left = (m.x * kx) + 'px';
            m.el.style.top = (m.y * ky) + 'px';
        });
    }

    function ajusterZones() {
        const img = document.getElementById('monImage');
        const kx = img.clientWidth / Taille, ky = img.clientHeight / Hauteur;
        if (!kx || !ky) return;
        document.querySelectorAll('#planIut area').forEach(function (a) {
            const c = a.dataset.coords.split(',').map(Number);
            let res;
            if (a.shape === 'circle') {
                res = [c[0] * kx, c[1] * ky, c[2] * kx];
            } else {
                res = c.map(function (v, i) { return v * (i % 2 === 0 ? kx : ky); });
            }
            a.coords = res.map(Math.round).join(',');
        });
        placerMarqueurs();
    }

    window.addEventListener('resize', ajusterZones);
    document.getElementById('monImage').addEventListener('load', ajusterZones);

    document.getElementById('monImage').addEventListener('click', function (e) {
        if (!e.ctrlKey) return;
        const r = this.getBoundingClientRect();
        console.log(Math.round((e.clientX - r.left) * Taille / r.width) + ',' +
                    Math.round((e.clientY - r.top) * Hauteur / r.height));
    });
</script>

<?php include '../includes/footer.php'; ?>
