
<?php
/**
 * @author Omid Amini bcs.omid@gmail.com 
 * */
require_once('../config/appConfig.php');
/**
 * check if the database parameteres file exist or not, if not it redirect you to page dbinfo.
 * */
if(!file_exists(CONFIG_DIR."db.php"))
{
    if($_GET['page'] != 'dbinfo')
    {
        header("location:".URL_BASE."public/?page=dbinfo");
    }  
}
else
{
    require_once(CONFIG_DIR."db.php");
}
?>
<?php
/**
 * application name 
 * @var string $appname
 */
$appname = "<h2 class='text-success'>phaln</h2>
<p class='text-success'>entities generator</p>";?>
<?php
 include_once('include/header.php');
/**
 * include a page if the get method is set and equal to the page name
 * @var array $_GET['page']
 */
if(isset($_GET['page']) && $_GET['page'] == 'table')
{
    include_once('table_entity_generator.php');
}
else if(isset($_GET['page']) && $_GET['page'] == 'db')
{
    include_once('db_entity_generator.php');
}
else if(isset($_GET['page']) && $_GET['page'] == 'dbinfo')
{
    include_once('dbinfo.php');
}
else
{
    include_once('accueil.php');
}

?>
