<?php
$titre = 'MBC – Accueil';
$page  = 'jeu';
$racine = '../';
include '../includes/header.php';
?>
    <div class = "pad">
        <div class="container">
            <h1>Évasion à l'IUT de Vélizy</h1>

            <h2>Le contexte</h2>
            <div class="scenario">
                <p class = "blanc">
                    Tu viens tout juste d'entrer dans le bâtiment de l'IUT de Vélizy pour récupérer un dossier oublié, mais catastrophe : la sécurité vient de verrouiller toutes les issues pour la nuit ! Le système de verrouillage centralisé est contrôlé par un ordinateur un peu capricieux qui exige de résoudre une série de défis mathématiques avant de débloquer les portes de sortie.
                </p>
            </div>

            <h2>Ton objectif</h2>
            <p>
                Explorer le plan de l'IUT à l'aide de ta souris, dénicher toutes les <strong>zones secrètes</strong> dissimulées dans les salles et couloirs, et résoudre l'intégralité des énigmes pour déverrouiller la sortie.
            </p>

            <h2>Déroulement de la partie</h2>
            <ol>
                <li>
                    <strong>Exploration du plan :</strong> Déplace ton curseur sur le plan de l'IUT. Certains lieux clés (salles de TP, amphithéâtres, cafétéria, secrétariat...) sont interactifs. Clique dessus pour déclencher une épreuve.
                </li>
                <li>
                    <strong>Résolution sous pression :</strong> Dès qu'une énigme s'affiche, un <strong>compte à rebours</strong> démarre (par exemple, 30 secondes). Tu dois trouver et valider la bonne réponse avant que le temps ne soit écoulé.
                </li>
                <li>
                    <strong>Validation des étapes :</strong> Chaque bonne réponse déverrouille une partie du système de sécurité. Une fois toutes les zones validées, la sortie principale s'ouvre et tu remportes la partie !
                </li>
            </ol>

            <div class="alert-box">
                <h2>Règles importantes et pénalités</h2>
                <ul>
                    <li>
                        <strong>Attention aux pièges mathématiques :</strong> Certaines équations possèdent <strong>plusieurs solutions</strong> (comme les équations du second degré). Pense à bien indiquer toutes les valeurs attendues pour valider ta réponse.
                    </li>
                    <li>
                        <strong>Temps écoulé :</strong> Si le chronomètre atteint zéro avant que tu ne valides, l'alarme retentit ! L'énigme est réinitialisée et tu devras retenter ta chance.
                    </li>
                    <li>
                        <strong>Pas de sortie prématurée :</strong> Il est impossible de quitter l'IUT tant que 100 % des énigmes n'ont pas été résolues.
                    </li>
                </ul>
            </div>

        </div>
    </div>
<?php include '../includes/footer.php'; ?>