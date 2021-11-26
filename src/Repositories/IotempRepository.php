<?php 
namespace Repositories;
use Phaln\AbstractRepository;
class IotempRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    $this->table = 'iotemp'; // appel du constructeur de phaln\Abs..
        $this->classMapped = 'Entities\Iotemp'; // Nom de la table à mapper avec ..
        $this->idFieldName = 'id';  // nom (ou table de noms) $this->idFieldName = ['id', 'nom'];
    }
}
?>
        