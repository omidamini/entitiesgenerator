<?php 
namespace Repositories;
use Phaln\AbstractRepository;
class EvaluationcompetenceetudiantRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    $this->table = 'evaluationcompetenceetudiant'; // appel du constructeur de phaln\Abs..
        $this->classMapped = 'Entities\Evaluationcompetenceetudiant'; // Nom de la table à mapper avec ..
        $this->idFieldName = 'id';  // nom (ou table de noms) $this->idFieldName = ['id', 'nom'];
    }
}
?>
        