
    <?php 
    /**
     * database information
     * @var array $infoBdd 
     */
    $infoBdd = array
    (
        'interface' => 'pdo', // "pdo" ou "mysqli"
        'type' => 'mysql', // mysql ou pgsql
        'host' => 'localhost', // Votre serveur de bdd
        'port' => 3306, // Par défaut: 5432 pour postgreSQL, 3306 pour MySQL
        'charset' => 'UTF8', // charset de la bdd
        'dbname' => 'olen_competence_light', // Le nom de la bdd
        'user' => 'root', // l'utilisateur de la bdd
        'pass' => '', // le password de l'utilisateur de la bdd
    );
    ?>