<?php

class ClasseTrajet{
    public $idTrajet;
    public $nom;
    public $debit;
    public $rugosite;
    public $temperature;
    public $idProjet;
    
    public $perte_charge;
    public $cote_depart;
    public $cote_arrivee;
    public $type;
    public $sens;
    
    public $hauteur;
    public $puissance;
    
    public array $pieces;
    function __construct() {   
    }
    
    public static function construct2(array $row,array $pieces){
        $instance = new self();
        $instance->idTrajet = $row['id_trajet'];
        $instance->nom = $row['nom_trajet'];
        $instance->debit = $row['debit'];
        $instance->rugosite = $row['rugosite'];
        $instance->temperature = $row['temperature'];
        $instance->idProjet = $row['id_projet'];
        
         $instance->cote_depart = $row['cote_depart'];
         $instance->perte_charge = $row['perte_charge'];
         $instance->cote_arrivee = $row['cote_arrivee'];
         $instance->type = $row['type'];
        $instance->sens = $row['sens'];
        
        $instance->hauteur = $row['hauteur'];
        $instance->puissance = $row['puissance'];
        
        $instance->pieces=$pieces;
        return $instance;
    }   
    
    
      public static function construct3(array $row){
        $instance = new self();
        $instance->idTrajet = $row['id_trajet'];
        $instance->nom = $row['nom_trajet'];
        $instance->idProjet = $row['id_projet'];
        return $instance;
    }   
    
    
    public function Calcul_Perte_de_Charge(){
        $p=0;
        foreach($this->pieces as $piece){
        $p=$p+$piece->get_Perte_de_Charge();
        }
         return $p;
     }
    
    public function get_perte_charge(){
        $p=0;
        foreach($this->pieces as $piece){
        $p=$p+$piece->get_Perte_de_Charge();
        }
        $instance->perte_charge=$p;
         return $instance->perte_charge;
     }
    
    
    
}
?>
