<?php 
namespace Repositories;
use Phaln\AbstractRepository;
class EtudiantRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    $this->table = 'etudiant'; // appel du constructeur de phaln\Abs..
        $this->classMapped = 'Entities\Etudiant'; // Nom de la table à mapper avec ..
        $this->idFieldName = 'id';  // nom (ou table de noms) $this->idFieldName = ['id', 'nom'];
    }
}
?>
        