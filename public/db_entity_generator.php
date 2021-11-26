<?php
/**
 * @author Omid Amini bcs.omid@gmail.com 
 * */
$success_message = $error_message = null;
$dbClassObj = new entitiesGenerator\DB();
    $entityfileCreated = null;
    
    if(isset($_POST['submit']))
    {
             $tabledata = $dbClassObj->selectTables();
            foreach($tabledata as $tablename)
            {
                $data = $dbClassObj->selecColumns($tablename);
                if(sizeof($data)>0)
                {
                    $entityfile = fopen(SRC_DIR."Entities".DIRECTORY_SEPARATOR.ucfirst($tablename).".php", "w") or die("Impossible de créer ou d'ouvrir le fichier d'entité.");
                    $entityTexts = 
"<?php
namespace Entities;
use Phaln\AbstractEntity;
class ".ucfirst($tablename)." extends AbstractEntity
{";
                    
                    foreach( $data as $column_name)
                    {
                    
                        $entityTexts .=
    "
    protected $".$column_name.";
    "; 
                    }
                    $entityTexts .=
"
}
?>";
                    if(fwrite($entityfile, $entityTexts))
                    {
                        // your message here
                    }
                    fclose($entityfile);

                    $repositoryfile = fopen(SRC_DIR."Repositories".DIRECTORY_SEPARATOR.ucfirst($tablename)."Repository".".php", "w") or die("Impossible de créer ou d'ouvrir le fichier d'entité");
                    $repositoryTexts = 
"<?php 
namespace Repositories;
use Phaln\AbstractRepository;
class ". ucfirst($tablename) ."Repository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    ";  
        $repositoryTexts.= 
        '$this->table = \''.$tablename.'\'; // appel du constructeur de phaln\Abs..
        $this->classMapped = \'Entities\\'. ucfirst($tablename).'\'; // Nom de la table à mapper avec ..
        $this->idFieldName = \'id\';  // nom (ou table de noms) $this->idFieldName = [\'id\', \'nom\'];
    }
}
?>
        '; 
                    if(fwrite($repositoryfile, $repositoryTexts))
                    {
                        $success_message = "Les entités et les Repositories ont été créés ";
                        
                    }
                    fclose($repositoryfile);
                } 
                        
            }
            
             
             
        
    }
?>

<body>
    <div class="container align-items-center  vh-100">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-sm-4 rounded  border">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>?page=db" class="form" method="POST">
                    <div class="row align-items-center h-100">
                        <div class="col-12 p-5">
                            <?php echo $appname; ?>
                                <input type="text" disabled name="dname" class="form-control mb-3" value="Base de données: <?php echo $infoBdd['dbname']?$infoBdd['dbname']:""; ?>" placeholder="Nom de la base de données">
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
                