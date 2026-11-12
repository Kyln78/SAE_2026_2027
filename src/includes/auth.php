<?php
const SESSION_DUREE = 60 * 60 * 24 * 30;

// Vérifie si la session est déjà démarrée, sinon démarre la session avec les paramètres appropriés
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.gc_maxlifetime', (string) SESSION_DUREE);
    session_set_cookie_params([
        'lifetime' => 0, // Le cookie de session expire à la fermeture du navigateur (sauf si on le prolonge manuellement plus bas avec "Se souvenir de moi")
        'path'     => '/', // Le cookie est disponible sur tout le site
        'httponly' => true, // Le cookie n'est pas accessible via JavaScript
        'samesite' => 'Lax', // Le cookie est envoyé uniquement pour les requêtes du même site (protection contre les attaques CSRF)
        'secure'   => !empty($_SERVER['HTTPS']), // Le cookie est envoyé uniquement sur les connexions HTTPS
    ]);
    session_start();
}

function e($texte): string
{
    return htmlspecialchars((string) $texte, ENT_QUOTES, 'UTF-8');
}

function pageRole(string $role): string
{
    if ($role === 'adminweb') {
        return 'adminweb.php';
    }
    if ($role === 'adminsys') {
        return 'adminsys.php';
    }
    return 'utilisateur.php';
}

function estConnecte(): bool
{
    return isset($_SESSION['user_id']); // Vérifie si l'utilisateur est connecté en vérifiant la présence de l'ID utilisateur dans la session
}

function connecterUtilisateur(int $id, string $identifiant, string $role, bool $souvenir): void
{
    $_SESSION['user_id'] = $id;
    $_SESSION['identifiant'] = $identifiant;
    $_SESSION['role'] = $role;

    if ($souvenir) { // Si l'utilisateur a choisi "Se souvenir de moi", on prolonge la durée de vie du cookie de session
        setcookie(session_name(), session_id(), [
            'expires'  => time() + SESSION_DUREE,
            'path'     => '/',
            'httponly' => true,
            'samesite' => 'Lax',
            'secure'   => !empty($_SERVER['HTTPS']),
        ]);
    }
}

function deconnecterUtilisateur(): void
{
    $_SESSION = [];
    setcookie(session_name(), '', time() - 3600, '/'); // Supprime le cookie de session en le mettant à une date passée
    session_destroy(); // Détruit la session
}
