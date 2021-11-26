<?php 
namespace Repositories;
use Phaln\AbstractRepository;
class CompetenceRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    $this->table = 'competence'; // appel du constructeur de phaln\Abs..
        $this->classMapped = 'Entities\Competence'; // Nom de la table à mapper avec ..
        $this->idFieldName = 'id';  // nom (ou table de noms) $this->idFieldName = ['id', 'nom'];
    }
}
?>
        