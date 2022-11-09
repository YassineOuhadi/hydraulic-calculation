
<?php

include_once '../include/Classes.php';
$bdd=fct_bdd();
$ManagerProjet = new ManagerProjet($bdd);

  $id=$_POST['id'];
  $idTrajet=$_POST['idTrajet']; 

  $row=$ManagerProjet->fct_find_by_idTrajet($idTrajet);
  $pieces = array();
  $select_pieces=$ManagerProjet->fct_find_pieces($idTrajet);
  foreach($select_pieces as $row_pieces){
     $piece = ClassePiece::construct2($row_pieces); 
     array_push($pieces,$piece);
  }
  $trajet = ClasseTrajet::construct2($row,$pieces);

  $i=0;
  foreach($trajet->pieces as $piece){ 
     if($i==$id){
         $name_piece=$piece->NomPiece;
         $id_piece=$piece->idPiece;
         $id=$piece->idAdjoindre;
         
         $categorie=$piece->categorie;
         
         $d=$piece->diametre;
         $_D=$piece->D;
         $k=$piece->k;
         
          $D1=$piece->D1;
          $D2=$piece->D2;
         
         $l=$piece->langueur;
         
         $angle=$piece->angle;
         $rayon=$piece->rayon;
         
         $debit=$piece->debit;
         $cote_depart=$piece->cote_depart;
         $perte_charge=$piece->perte_charge;
         $cote_arrivee=$piece->cote_arrivee;
     }
      else{
          $i=$i+1;
      };
  };
  echo json_encode(array("name_piece"=>$name_piece,"id_piece"=>$id_piece,"categorie"=>$categorie,"id"=>$id,"d"=>$d,"_D"=>$_D,"k"=>$k,"l"=>$l,"angle"=>$angle,"rayon"=>$rayon,"debit"=>$debit,"D1"=>$D1,"D2"=>$D2,"cote_depart"=>$cote_depart,"perte_charge"=>$perte_charge,"cote_arrivee"=>$cote_arrivee));

?>
