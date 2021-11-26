<?php
/**
 * @author Omid Amini bcs.omid@gmail.com 
 * */
/**
 * require app configuration
 */
require_once 'config/appConfig.php';
/**
 * @var string $url website main page  address
 *  */ 
$url = URL_BASE.'public/index.php';
/**
 * redirect to website main page  address
 */
header("location: $url") ;
exit();
?>