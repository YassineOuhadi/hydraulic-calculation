<?php
class ClasseProjet{
    public $idProjet;
    public $titre;
    public $idCompte;
    
    function __construct() {   
    }
    
    public static function construct2(array $row){
        $instance = new self();
        $instance->idProjet = $row['id_projet'];
        $instance->titre = $row['titre_projet'];
        $instance->idCompte = $row['id_compte'];
        
        return $instance;
    }      
}
?>


<?php
/*class ClasseProjet{
    public $idProjet;
    public $titre;
    public $test;
    public $idCompte;
    public array $trajets;
    function __construct() {   
    }
    
    public static function construct2(array $row,array $trajets){
        $instance = new self();
        $instance->idProjet = $row['id_projet'];
        $instance->titre = $row['titre_projet'];
        $instance->test = $row['test_projet'];
        $instance->idCompte = $row['id_compte'];
        $instance->trajets=$trajets;
        return $instance;
    }   
    
}*/
?>
