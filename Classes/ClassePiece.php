<?php

class ClassePiece{
    
    public $idTrajet;
    public $idAdjoindre;
    public $idPiece;
    public $NomPiece;
   
    
    public $categorie;
    
    
    public $diametre;
    public $D;
    public $k;
    
    public $D1;
    public $D2;
    
    public $langueur;
    
    public $angle;
    public $rayon;
    
    public $debit;
    public $cote_depart;
    public $perte_charge;
    public $cote_arrivee;
  
    function __construct() {   
    }
    
    public static function construct2($row){
        $instance = new self();
        $instance->idAdjoindre = $row['id'];
        $instance->idTrajet = $row['id_trajet'];
        $instance->idPiece = $row['id_piece'];
        $instance->NomPiece = $row['nom_piece'];
        
        $instance->categorie = $row['categorie_libelle'];
        
        
     
        
        $instance->diametre = $row['Diametre'];
        $instance->D = $row['D'];
        $instance->k = $row['k'];
        
        $instance->D1 = $row['D1'];
        $instance->D2 = $row['D2'];
        
        $instance->langueur = $row['langueur'];
        $instance->angle = $row['angle'];
        $instance->rayon = $row['rayon'];
        
        $instance->debit = $row['debit'];
        $instance->cote_depart = $row['cote_depart'];
        $instance->perte_charge = $row['perte_charge'];
        $instance->cote_arrivee = $row['cote_arrivee'];
        
        return $instance;
    }
    
    public function get_cote_depart(){
         return $this->cote_depart;
     }
    public function get_Perte_de_Charge(){
         return $this->perte_charge;
     }
    public function get_cote_arrivee(){
         return $this->cote_arrivee;
     }
     
}
?>