<?php
/**
 * @var string $success_message success_message, 
 * @var string $error_message error_message
 * */
$success_message = $error_message = null;
$dbClassObj = new entitiesGenerator\DB();
    $name = $entityfileCreated = null;
    
    if(isset($_POST['submit']))
    {
        if(!empty(trim(strip_tags(html_entity_decode(pg_escape_string($_POST['tname']))))))
        {
             $name = trim(strip_tags(html_entity_decode(pg_escape_string($_POST['tname']))));
             $data = $dbClassObj->selecColumns($name);
             if(sizeof($data)>0)
             {
                $entityfile = fopen(SRC_DIR."Entities".DIRECTORY_SEPARATOR.ucfirst($name).".php", "w") or die("Unable to create or open entity file!");
                $entityTexts = 
"<?php
namespace Entities;
    use Phaln\AbstractEntity;
    class ".ucfirst($name)." extends AbstractEntity
    {";
        foreach($data as $columnName)
        {
            $entityTexts .="
            protected $".$columnName.";
            ";
            
        }
        $entityTexts .="
    }
?>";
                if(fwrite($entityfile, $entityTexts))
                {
                    //your message here
                }
                fclose($entityfile);

                $repositoryfile = fopen(SRC_DIR."Repositories".DIRECTORY_SEPARATOR.ucfirst($name)."Repository".".php", "w") or die("Unable to create or open repository file!");
                $repositoryTexts = "
<?php 
namespace Repositories;
use Phaln\AbstractRepository;
class ". ucfirst($name) ."Repository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    ";  
        $repositoryTexts.= 
        '$this->table = \''.$name.'\'; // appel du constructeur de phaln\Abs..
        $this->classMapped = \'Entities\\'. ucfirst($name).'\'; // Nom de la table à mapper avec ..
        $this->idFieldName = \'id\';  // nom (ou table de noms) $this->idFieldName = [\'id\', \'nom\'];
    }
}
?>
';         
                if(fwrite($repositoryfile, $repositoryTexts))
                {
                    $success_message = "L'entité et le Repository : ". ucfirst($name) . " ont été créés ";
                }
                fclose($repositoryfile);    
             }
             else
             {
                 $error_message = "La table {$name} est n'existe pas.";
             }
            

             
        }
        else
        {
            $error_message = "Le champ n'accepte pas certains caractères spéciaux";
        }

    }
?>

<body>
    <div class="container align-items-center  vh-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-sm-4 rounded  border">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=table">
                    <div class="row align-items-center h-100">
                        <div class="col-12 p-5">
                            <?php echo $appname; ?>
                                <input type="text" name="tname" class="form-control mb-3" value="<?php echo $name?$name:""; ?>" placeholder="Nom de la table" required>
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