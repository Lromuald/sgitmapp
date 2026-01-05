<?php
/**
 * Fichier d'initialisation de l'application
 * Système de Gestion Intégrée
 */

// Démarrage de la session sécurisée
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Mettre à 1 en HTTPS
ini_set('session.cookie_samesite', 'Strict');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Régénération de l'ID de session après connexion
if (isset($_SESSION['user_id']) && !isset($_SESSION['session_regenerated'])) {
    session_regenerate_id(true);
    $_SESSION['session_regenerated'] = true;
}

// Vérification du timeout de session
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > SESSION_LIFETIME)) {
    session_unset();
    session_destroy();
    header('Location: ' . BASE_URL . '/login.php?timeout=1');
    exit();
}
$_SESSION['last_activity'] = time();

// Chargement des fichiers de configuration
require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/database.php';

// Autoloader pour les classes
spl_autoload_register(function ($class) {
    $directories = [
        APP_PATH . '/Controllers/',
        APP_PATH . '/Models/',
        APP_PATH . '/Helpers/'
    ];
    
    foreach ($directories as $directory) {
        $file = $directory . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Création des dossiers d'upload si nécessaire
$uploadDirs = [
    UPLOAD_PATH,
    DOCUMENTS_PATH,
    PHOTOS_PATH
];

foreach ($uploadDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Fonction helper pour les redirections
function redirect($url, $message = null, $type = MSG_INFO) {
    if ($message) {
        $_SESSION['flash_message'] = $message;
        $_SESSION['flash_type'] = $type;
    }
    header('Location: ' . $url);
    exit();
}

// Fonction helper pour les messages flash
function getFlashMessage() {
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        $type = $_SESSION['flash_type'] ?? MSG_INFO;
        unset($_SESSION['flash_message'], $_SESSION['flash_type']);
        return ['message' => $message, 'type' => $type];
    }
    return null;
}

// Fonction helper pour vérifier l'authentification
function requireAuth() {
    if (!isset($_SESSION['user_id'])) {
        redirect(BASE_URL . '/login.php', 'Veuillez vous connecter', MSG_WARNING);
    }
}

// Fonction helper pour vérifier les permissions
function requireRole($allowedRoles) {
    requireAuth();
    if (!in_array($_SESSION['user_role'], (array)$allowedRoles)) {
        redirect(BASE_URL . '/dashboard.php', 'Accès non autorisé', MSG_ERROR);
    }
}

// Fonction helper pour échapper les données
function escape($data) {
    if (is_array($data)) {
        return array_map('escape', $data);
    }
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Fonction helper pour formater les dates
function formatDate($date, $format = 'd/m/Y') {
    if (!$date) return '-';
    $timestamp = is_numeric($date) ? $date : strtotime($date);
    return date($format, $timestamp);
}

// Fonction helper pour formater les montants
function formatMontant($montant, $devise = 'FCFA') {
    return number_format($montant, 0, ',', ' ') . ' ' . $devise;
}

// Fonction helper pour générer un token CSRF
function generateCsrfToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Fonction helper pour vérifier un token CSRF
function verifyCsrfToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Gestion des erreurs en production
if (!defined('DEBUG_MODE')) {
    define('DEBUG_MODE', false);
}

if (!DEBUG_MODE) {
    error_reporting(0);
    ini_set('display_errors', 0);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}