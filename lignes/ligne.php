
<?php

include_once '../include/Classes.php';
$bdd=fct_bdd();
$ManagerProjet = new ManagerProjet($bdd);

  $idTrajet=$_POST['idTrajet']; 

  $row=$ManagerProjet->fct_find_by_idTrajet($idTrajet);

$pieces = array();

$select_pieces=$ManagerProjet->fct_find_pieces($idTrajet);

foreach($select_pieces as $row_pieces){
    $piece = ClassePiece::construct2($row_pieces); 
    array_push($pieces,$piece);
}

$trajet = ClasseTrajet::construct2($row,$pieces);
$row=$ManagerProjet->fct_find_projet($trajet->idProjet);

$projet= ClasseProjet::construct2($row);
  
         $nom=$trajet->nom;
         $idTrajet=$trajet->idTrajet;
         $idProjet=$trajet->idProjet;
         $titre_projet=$projet->titre;
         $debit=$trajet->debit;
         $rugosite=$trajet->rugosite;
         $temperature=$trajet->temperature;
         $type=$trajet->type;$sens=$trajet->sens;
         $cote_depart=$trajet->cote_depart;
         $perte_charge=$trajet->perte_charge;
         $cote_arrivee=$trajet->cote_arrivee;

        $hauteur=$trajet->hauteur;
        $puissance=$trajet->puissance;
     
  
  echo json_encode(array("nom"=>$nom,"idTrajet"=>$idTrajet,"idProjet"=>$idProjet,"titre_projet"=>$titre_projet,"debit"=>$debit,"rugosite"=>$rugosite,
                        "temperature"=>$temperature,"type"=>$type,"sens"=>$sens,"cote_depart"=>$cote_depart, 
                         "perte_charge"=>$perte_charge,"cote_arrivee"=>$cote_arrivee,"hauteur"=>$hauteur,"puissance"=>$puissance));

?>
