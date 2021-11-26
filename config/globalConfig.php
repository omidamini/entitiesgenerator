<?php
/**
 * @author Omid Amini bcs.omid@gmail.com 
 * */
// Définition des chemins:
define('BASE_DIR', dirname(dirname(__FILE__)));  // Le dossier de l'application
define('PUBLIC_DIR', BASE_DIR . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);	//  Pour les fichiers publics
define('CONFIG_DIR', BASE_DIR . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR);	//  Pour les fichiers de configuration
define('SRC_DIR', BASE_DIR . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR);	//  Pour les espaces de nom de vos classes
define('VENDOR_DIR', BASE_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR);	//  Pour /vendor
define('ENTITIESGENERATOR_DIR', VENDOR_DIR . 'entitiesGenerator' . DIRECTORY_SEPARATOR);			//  Pour la librairie entitiesGenerator
define('LOG_DIR', BASE_DIR . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR);	//  Pour les fichiers de journalisation
define('TEMPLATE_PATH', SRC_DIR . 'App' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR); //  Pour les templates
//  Définition du path d'inclusion
define('CLASS_DIR', SRC_DIR . PATH_SEPARATOR . ENTITIESGENERATOR_DIR);
set_include_path(get_include_path() . PATH_SEPARATOR . CLASS_DIR);


//  Active ou pas l'affichage de debug et les var_dump
if (DUMP) 
{
    error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', 'On');
} 
else 
{
    error_reporting(E_ALL);
    ini_set('display_errors', 'Off');
    ini_set('log_errors', 'On');
    ini_set('error_log', LOG_DIR . 'error_log.txt');
}

//  Si la librairie entitiesGenerator est utilisée, il faut la configurer avec 
//  les informations de connexion à la base de données.
//  Ces informations se trouve dans appConfig.php
include_once ENTITIESGENERATOR_DIR  . 'db.php';

