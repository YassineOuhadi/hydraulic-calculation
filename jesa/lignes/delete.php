<?php
include_once '../include/Classes.php';
$bdd=fct_bdd();
$ManagerProjet = new ManagerProjet($bdd);
$id=$_POST['id'];
$ManagerProjet->supprimer_piece($id);
?>
