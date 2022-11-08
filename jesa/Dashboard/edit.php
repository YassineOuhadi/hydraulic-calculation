<?php
include_once '../include/Classes.php';
$bdd=fct_bdd();
$ManagerProjet = new ManagerProjet($bdd);
$idProjet=$_POST['idProjet'];
$titre=$_POST['titre'];
$ManagerProjet->edit_projet($idProjet,$titre);   
?>
