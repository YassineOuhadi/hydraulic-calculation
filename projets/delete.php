<?php
include_once '../include/Classes.php';
$bdd=fct_bdd();
$ManagerProjet = new ManagerProjet($bdd);
if (isset($_POST["idProjet"])) {
    $idProjet=$_POST['idProjet'];
    $ManagerProjet->supprimer_trajets($idProjet);
    $ManagerProjet->supprimer_projet($idProjet);   
} 
else if (isset($_POST["idTrajet"])) {    
    $idTrajet=$_POST['idTrajet'];
    $ManagerProjet->supprimer_pieces($idTrajet);
    $ManagerProjet->supprimer($idTrajet);
};
?>
