<?php
/**
 * Constantes de l'application
 * Système de Gestion Intégrée
 */

// Chemins
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
define('PUBLIC_PATH', BASE_PATH . '/public');
define('UPLOAD_PATH', BASE_PATH . '/uploads');
define('DOCUMENTS_PATH', UPLOAD_PATH . '/documents');
define('PHOTOS_PATH', UPLOAD_PATH . '/photos');

// URL
define('BASE_URL', 'http://localhost/sgitmapp');
define('ASSETS_URL', BASE_URL . '/public');

// Sécurité
define('SESSION_LIFETIME', 1800); // 30 minutes
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_BLOCK_DURATION', 900); // 15 minutes

// Upload
define('MAX_FILE_SIZE', 10485760); // 10 Mo
define('ALLOWED_EXTENSIONS', ['pdf', 'jpg', 'jpeg', 'png']);

// Pagination
define('DEFAULT_PER_PAGE', 25);
define('PER_PAGE_OPTIONS', [10, 25, 50, 100]);

// Alertes documents
define('ALERT_DAYS_INFO', 30);
define('ALERT_DAYS_WARNING', 15);
define('ALERT_DAYS_URGENT', 3);

// Carburant
define('SURCONSOMMATION_THRESHOLD', 20); // Pourcentage
define('CONSOMMATION_PERIOD_DAYS', 30);

// Rôles
define('ROLE_ADMIN', 1);
define('ROLE_GESTIONNAIRE_STOCK', 2);
define('ROLE_MAINTENANCE', 3);
define('ROLE_COMMERCIAL', 4);
define('ROLE_LECTURE', 5);

// Statuts engins
define('ENGIN_DISPONIBLE', 'disponible');
define('ENGIN_EN_MISSION', 'en_mission');
define('ENGIN_EN_MAINTENANCE', 'en_maintenance');
define('ENGIN_HORS_SERVICE', 'hors_service');

// Types de maintenance
define('MAINTENANCE_PREVENTIVE', 'preventive');
define('MAINTENANCE_CORRECTIVE', 'corrective');

// Statuts maintenance
define('MAINTENANCE_PLANIFIEE', 'planifiee');
define('MAINTENANCE_EN_COURS', 'en_cours');
define('MAINTENANCE_TERMINEE', 'terminee');
define('MAINTENANCE_ANNULEE', 'annulee');

// Statuts livraison
define('LIVRAISON_PLANIFIEE', 'planifiee');
define('LIVRAISON_EN_COURS', 'en_cours');
define('LIVRAISON_LIVREE', 'livree');
define('LIVRAISON_ANNULEE', 'annulee');

// Statuts paiement
define('PAIEMENT_IMPAYEE', 'impayee');
define('PAIEMENT_PARTIEL', 'partiel');
define('PAIEMENT_PAYEE', 'payee');

// Types de documents
define('DOC_CARTE_GRISE', 'carte_grise');
define('DOC_ASSURANCE', 'assurance');
define('DOC_CARTE_TRANSPORT', 'carte_transport');
define('DOC_CARTE_STATIONNEMENT', 'carte_stationnement');
define('DOC_VISITE_TECHNIQUE', 'visite_technique');

// Documents critiques
define('DOCUMENTS_CRITIQUES', [
    DOC_CARTE_GRISE,
    DOC_ASSURANCE,
    DOC_CARTE_TRANSPORT,
    DOC_VISITE_TECHNIQUE
]);

// Types de pièces
define('PIECE_CARBURANT', 'carburant');
define('PIECE_FILTRE', 'filtre');
define('PIECE_PNEU', 'pneu');
define('PIECE_USURE', 'piece_usure');
define('PIECE_HUILE', 'huile');
define('PIECE_BATTERIE', 'batterie');
define('PIECE_AUTRE', 'autre');

// Messages
define('MSG_SUCCESS', 'success');
define('MSG_ERROR', 'error');
define('MSG_WARNING', 'warning');
define('MSG_INFO', 'info');