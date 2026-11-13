<?php
mysqli_report(MYSQLI_REPORT_OFF);

const DB_HOST = 'localhost';
const DB_USER = 'adminsys';
const DB_PASS = '';
const DB_BASE = 'mbc';

function connecter($host = DB_HOST, $user = DB_USER, $pass = DB_PASS, $base = DB_BASE)
{
    $connexion = @mysqli_connect($host, $user, $pass);
    if (!$connexion) {
        error_log('Connexion MySQL impossible (' . mysqli_connect_errno() . ') : ' . mysqli_connect_error()); // Log l'erreur de connexion
        return false;
    }
    mysqli_set_charset($connexion, 'utf8mb4'); // Définit le jeu de caractères pour la connexion
    if (!mysqli_select_db($connexion, $base)) {
        error_log('Base introuvable : ' . mysqli_error($connexion));
        mysqli_close($connexion);
        return false;
    }
    return $connexion;
}

function deconnecter($connexion)
{
    if ($connexion) {
        mysqli_close($connexion);
    }
}

function trouverUtilisateur($connexion, string $identifiant): ?array
{
    $sql = "SELECT id, password, role FROM utilisateurs WHERE username = ?";
    $req = mysqli_prepare($connexion, $sql); // Prépare la requête SQL pour éviter les injections SQL
    mysqli_stmt_bind_param($req, 's', $identifiant); // Lie l'identifiant à la requête préparée
    mysqli_stmt_execute($req); // Exécute la requête préparée
    $result = mysqli_stmt_get_result($req); // Récupère le résultat de la requête
    $row = mysqli_fetch_assoc($result); // Récupère la première ligne du résultat sous forme de tableau associatif
    mysqli_stmt_close($req); // Ferme la requête préparée pour libérer les ressources
    return $row ?: null; // Retourne le tableau associatif si trouvé, sinon null
}

function creerUtilisateur($connexion, string $identifiant, string $mdp)
{
    $hash = password_hash($mdp, PASSWORD_DEFAULT);
    $sql  = "INSERT INTO utilisateurs (username, password) VALUES (?, ?)";
    $req  = mysqli_prepare($connexion, $sql); // Prépare la requête SQL pour éviter les injections SQL
    mysqli_stmt_bind_param($req, 'ss', $identifiant, $hash); // Lie l'identifiant et le mot de passe haché à la requête préparée
    $ok = mysqli_stmt_execute($req); // Exécute la requête préparée et stocke le résultat (true si succès, false sinon)
    $id = mysqli_stmt_insert_id($req); // Récupère l'ID de l'utilisateur nouvellement créé
    mysqli_stmt_close($req); // Ferme la requête préparée pour libérer les ressources
    return $ok ? $id : false; // Retourne l'ID de l'utilisateur si succès, sinon false
}
