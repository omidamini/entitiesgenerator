<?php
/**
 * @author Omid Amini bcs.omid@gmail.com 
 * */
// Basculer à TRUE pour activer les affichages de debug, les var_dump ou les dump_var
define('DUMP', true);
define('DUMP_EXCEPTIONS', false);
// L'url de votre site, sera utile dans les pages en cas de déplacement du site...
define('URL_BASE', 'http://localhost/entitiesgenerator/');
// Les informations de connexion à la BDD


// Inclusion de la configuration globale
require_once 'globalConfig.php';
try {
// Lancement des sessions, si ce n'est pas déjà fait.
// Le faire après l'inclusion de 'globalConfig.php' permet d'avoir l'autoload actif
// et de pouvoir désérializer des objets depuis les sessions.
 if (session_status() === PHP_SESSION_NONE) {
 session_start();
 }
} catch (Throwable $ex) {
 var_dump($ex);
}
//use to show a success message
$success_msg;
$error_msg;
//use to show a success message
?>
