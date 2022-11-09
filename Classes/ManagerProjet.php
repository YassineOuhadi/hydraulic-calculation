<?php

Class ManagerProjet{
    
    private $db;
    
    public function __construct($db){
        $this->db = $db;
    }
    
    public function fct_find_by_id($id){ 
        $result=$this->db->query("SELECT * FROM jesadatabase.projet where id_compte='$id';");
        return $result;
    }
    public function fct_find_projets($id){ 
        $result=$this->db->query("SELECT * FROM jesadatabase.projet where id_compte='$id';");
        return $result;
    }
     public function fct_find_projet($id){ 
        $result=$this->db->query("SELECT * FROM jesadatabase.projet where id_projet='$id';");
         $row=$result->fetch();
        return $row;
    }
    
    public function fct_find_count($id){
        $result = $this->db->query("SELECT count(*) as count  FROM jesadatabase.projet where id_compte='$id'");
      $row=$result->fetch();
        return $row['count'];
    }
    
    public function fct_find_count_trajets($id){
        $result = $this->db->query("SELECT count(*) as count  FROM jesadatabase.trajet where id_projet='$id'");
      $row=$result->fetch();
        return $row['count'];
    }
    
    public function fct_find_trajets($id){
        $result = $this->db->query("SELECT *  FROM jesadatabase.trajet where id_projet='$id';");
      return $result;
    }
    
    public function fct_test($id){
        $result = $this->db->query("SELECT *  FROM jesadatabase.trajet where id_projet='$id';");
      return $result;
    }
  
    
public function fct_find_pieces($id){
$result = $this->db->query("SELECT * FROM jesadatabase.adjoindre NATURAL JOIN jesadatabase.pieces NATURAL JOIN jesadatabase.categories where id_trajet='$id';");
return $result;
}
    
public function adjoindre(){
$result = $this->db->query("select * from jesadatabase.trajet t LEFT JOIN (SELECT * FROM jesadatabase.adjoindre NATURAL JOIN jesadatabase.pieces) a on t.id_trajet=a.id_trajet   ;");
return $result;
}    
    
  
public function fct_find_all_categories(){
$result = $this->db->query("SELECT * FROM jesadatabase.categories;");
return $result;
}
    
public function fct_find_all_pieces($id){
$result = $this->db->query("SELECT * FROM jesadatabase.pieces NATURAL JOIN jesadatabase.categories where categorie_id='$id';");
return $result;
} 
    
public function fct_find_all_hh(){
$result = $this->db->query("SELECT * FROM jesadatabase.pieces NATURAL JOIN jesadatabase.categories order by categorie_id;");
return $result;
} 
        
public function fct_count_pieces($id){
$result = $this->db->query("SELECT count(*) as count FROM jesadatabase.adjoindre a,jesadatabase.pieces p where a.id_piece=p.id_piece and a.id_trajet='$id' ;");
$row=$result->fetch();
return $row['count'];
}    
    
    public function fct_find_by_idTrajet($id){
         $result=$this->db->query("SELECT * FROM jesadatabase.trajet where id_trajet='$id';");
         $row=$result->fetch();
        return $row;
    }
    
    
    public function fct_insert_trajet($id,$name,$debit,$rugosite,$temperature,$depart,$type,$sens){
    $stmt = $this->db->prepare("INSERT INTO `jesadatabase`.`trajet` (`nom_trajet`, `debit`, `rugosite`, `temperature`, `id_projet`, `cote_depart`, `perte_charge`, `cote_arrivee`, `type`, `sens`) VALUES ('$name', '$debit', '$rugosite','$temperature', '$id', '$depart','0','0', '$type','$sens');");
       $stmt->execute();
    }
    
    public function fct_insert_projet($idCompte,$bb){
    $stmt = $this->db->prepare("INSERT INTO `jesadatabase`.`projet` (`titre_projet`, `id_compte`) VALUES ('$bb', '$idCompte');");
        $stmt->execute();
        $result=$this->db->query("SELECT max(id_projet) as max FROM jesadatabase.projet;");
       $row=$result->fetch();
        return $row['max'];
        
    }
        
        
public function insert($debit,$idTrajet,$idPiece,$diam,$D,$k,$l,$angle,$rayon,$D1,$D2,$CoteDepart,$PerteCharge,$CoteArrivee){
        $stmt = $this->db->prepare("INSERT INTO `jesadatabase`.`adjoindre` 
        (`id_trajet`, `id_piece`, `Diametre`,`D`,`k`, `langueur`,`angle`,`rayon`,`debit`,`D1`,`D2`,`cote_depart`,`perte_charge`,`cote_arrivee`) 
        VALUES ('$idTrajet', '$idPiece', '$diam','$D', '$k', '$l','$angle','$rayon', '$debit','$D1','$D2', '$CoteDepart', '$PerteCharge', '$CoteArrivee');");
       $stmt->execute();
    }
    
   public function update($debit,$id,$diam,$D,$k,$l,$angle,$rayon,$D1,$D2,$CoteDepart,$PerteCharge,$CoteArrivee){
        $stmt = $this->db->prepare("UPDATE `jesadatabase`.`adjoindre` SET 
                                                                 `Diametre` = '$diam',
                                                                 `D` = '$D',
                                                                 `k` = '$k', 
                                                                 `langueur` = '$l' ,
                                                                 `angle` = '$angle' ,
                                                                 `rayon` = '$rayon' ,
                                                                 `debit`=$debit,
                                                                 `D1`=$D1,
                                                                 `D2`=$D2,
                                                                 `cote_depart` = '$CoteDepart', 
                                                                  `perte_charge` = '$PerteCharge', 
                                                                  `cote_arrivee` = '$CoteArrivee'
        WHERE (`id` = '$id');");
       $stmt->execute();
    } 
    
   public function update_trajet($idTrajet,$debit,$rugosite,$temperature,$type,$sens,$CoteDepart,$PerteCharge,$CoteArrivee,$hauteur,$puissance){
        $stmt = $this->db->prepare("UPDATE `jesadatabase`.`trajet` SET `debit` = '$debit', `rugosite` = '$rugosite', `temperature` = '$temperature' ,
        `cote_depart` = '$CoteDepart', `perte_charge` = '$PerteCharge', `cote_arrivee` = '$CoteArrivee', `type` = '$type', `sens` = '$sens',`hauteur` = '$hauteur',`puissance` = '$puissance'
        WHERE (`id_trajet` = '$idTrajet');");
       $stmt->execute();
    }

    public function supprimer($idTrajet){
        $stmt = $this->db->prepare("DELETE FROM `jesadatabase`.`trajet` WHERE (`id_trajet` = '$idTrajet');");
       $stmt->execute();
    }
    public function supprimer_pieces($idTrajet){
        $stmt = $this->db->prepare("DELETE FROM `jesadatabase`.`adjoindre` WHERE (`id_trajet` = '$idTrajet');");
       $stmt->execute();
    }
    public function supprimer_piece($id){
        $stmt = $this->db->prepare("DELETE FROM `jesadatabase`.`adjoindre` WHERE (`id` = '$id');");
       $stmt->execute();
    } 
    public function supprimer_projet($idProjet){
        $stmt = $this->db->prepare("DELETE FROM `jesadatabase`.`projet` WHERE (`id_projet` = '$idProjet');");
       $stmt->execute();
    }
    public function supprimer_trajets($idProjet){
        $stmt = $this->db->prepare("DELETE FROM `jesadatabase`.`trajet` WHERE (`id_projet` = '$idProjet');");
       $stmt->execute();
    }
    public function edit_projet($idProjet,$titre){
        $stmt = $this->db->prepare("UPDATE `jesadatabase`.`projet` SET `titre_projet` = '$titre' WHERE (`id_projet` = '$idProjet');");
       $stmt->execute();
    }
    public function fct_create_account($email,$pseudo,$img,$password){
        $stmt = $this->db->prepare("INSERT INTO `jesadatabase`.`compte` (`email`, `password`, `image`, `username`) 
                                    VALUES ('$email', '$password', '$img', '$pseudo');");
        $stmt->execute();
    }
    
    public function count($id){
    $result = $this->db->query("SELECT count(*) as count FROM jesadatabase.adjoindre where id_trajet='$id' ;");
    $row=$result->fetch();
     return $row['count'];
     }
}
?>