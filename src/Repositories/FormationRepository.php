
<?php 
namespace Repositories;
use Phaln\AbstractRepository;
class FormationRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    $this->table = 'Formation'; // appel du constructeur de phaln\Abs..
        $this->classMapped = 'Entities\Formation'; // Nom de la table à mapper avec ..
        $this->idFieldName = 'id';  // nom (ou table de noms) $this->idFieldName = ['id', 'nom'];
    }
}
?>
