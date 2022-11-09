<?php

$select_trajets=$ManagerProjet->fct_find_trajets($id_projet);
foreach($select_trajets as $row_trajets){
    $pieces = array();
    $select_pieces=$ManagerProjet->fct_find_pieces($row_trajets['id_trajet']);
    foreach($select_pieces as $row_pieces){
        $piece = ClassePiece::construct2($row_pieces); 
        array_push($pieces,$piece);
    }
    $trajet = ClasseTrajet::construct2($row_trajets,$pieces); 
    $trajets[] = $trajet;
}

?>

