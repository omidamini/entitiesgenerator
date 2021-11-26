<?php 
namespace Repositories;
use Phaln\AbstractRepository;
class TuteurRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    $this->table = 'tuteur'; // appel du constructeur de phaln\Abs..
        $this->classMapped = 'Entities\Tuteur'; // Nom de la table à mapper avec ..
        $this->idFieldName = 'id';  // nom (ou table de noms) $this->idFieldName = ['id', 'nom'];
    }
}
?>
        