<?php
/**
 * generate db.php file in Config folder
 * @author Omid Amini bcs.omid@gmail.com
 */
$success_message = $error_message = $type = $host = $port = $dbname = $user = $password = $dbText = null;
if(isset($_POST['submit']))
{
    $dbfile = fopen(CONFIG_DIR."db.php", "w") or die("Unable to create or open entity file!");
    $type = trim(strip_tags(html_entity_decode(pg_escape_string(preg_replace('/[^A-Za-z0-9\-]/', '',$_POST['type'])))));
    $host = trim(strip_tags(html_entity_decode(pg_escape_string($_POST['host']))));
    if(trim($_POST['port']) == null)
    {
        if($_POST['type'] == 'mysql')
        {
            $port = 3306;
        }
        else 
        {
            $port = 5432;
        } 
    }
    else
    {
        $port = trim(strip_tags(html_entity_decode(pg_escape_string(preg_replace('/[^A-Za-z0-9\-]/', '',$_POST['port'])))));
    }
    $dbname = trim(strip_tags(html_entity_decode(pg_escape_string($_POST['dbname']))));
    $user = trim(strip_tags(html_entity_decode(pg_escape_string($_POST['user']))));
    $password = trim(strip_tags(html_entity_decode(pg_escape_string($_POST['pass']))));
    $dbText = "
    <?php 
    /**
     * database information
     * @var array infoBdd 
     */
    \$infoBdd = array
    (
        'interface' => 'pdo', // \"pdo\" ou \"mysqli\"
        'type' => '".$type."', // mysql ou pgsql
        'host' => '".$host."', // Votre serveur de bdd
        'port' => ".$port.", // Par défaut: 5432 pour postgreSQL, 3306 pour MySQL
        'charset' => 'UTF8', // charset de la bdd
        'dbname' => '".$dbname."', // Le nom de la bdd
        'user' => '".$user."', // l'utilisateur de la bdd
        'pass' => '". $password . "', // le password de l'utilisateur de la bdd
    );
    ?>";
    if(fwrite($dbfile, $dbText))
    {
        fclose($dbfile);
        header("location:".URL_BASE); 
    }
    else
    {
        fclose($dbfile);
        $error_message = "Impossible de créer des informations de base de données.";
    }
    
}


?>

<body>
    <div class="container align-items-center  vh-100">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-sm-4 rounded  border">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>?page=dbinfo" class="form" method="POST">
                    <div class="row align-items-center h-100">
                        <div class="col-12 p-5">
                            <?php echo $appname; ?>
                                <input type="text" name="host" class="form-control mb-3" value="<?php echo $host?$host:""; ?>" placeholder="Votre serveur *" required>
                                <select class="form-select mb-3" name="type" required>
                                    <option value="pgsql">pgsql</option>
                                    <option value="mysql" selected>mysql</option>
                                </select>
                                <input type="text" name="dbname" class="form-control mb-3" value="<?php echo $dbname?$dbname:""; ?>" placeholder="Nom de la base de données *" required>
                                <input type="text" name="user" class="form-control mb-3" value="<?php echo $user?$user:""; ?>" placeholder="Nom d'utilisateur *" required>
                                <input type="password" name="pass" class="form-control mb-3" value="<?php echo $password?$password:""; ?>" placeholder="Mot de passe">
                                <input type="number" name="port" class="form-control mb-3" value="<?php echo $port?$port:""; ?>" placeholder="Port">
                            <p>
                                <button type="submit" name="submit" class="btn btn-success">Valider</button>
                            </p>
                            <small >msg: <span class="text-success"> <?php echo ($success_message); ?></span><span class="text-danger"><?php echo ($error_message); ?></span></small>
                        </div>
                        <div class="col-12 align-self-en">
                            <p class="align-bottom text-end">
                                <a href="<?php echo URL_BASE; ?>" class="text-decoration-none link-success fs-4"><i class="bi bi-arrow-return-left"></i></a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>