
<?php

include_once '../include/Classes.php';
$bdd=fct_bdd();
$ManagerProjet = new ManagerProjet($bdd);

$idTrajet=$_POST['idTrajet'];
$debit=$_POST['debit'];
$rugosite=$_POST['rugosite'];
$temperature=$_POST['temperature'];

$type=$_POST['type'];$sens=$_POST['sens'];
$CoteDepart=$_POST['CoteDepart'];
$PerteCharge=$_POST['PerteCharge'];
$CoteArrivee=$_POST['CoteArrivee'];
 $hauteur=0;
$puissance=0;

  if($type=="Refoulement"){
      $hauteur=$_POST['hauteur'];
      $puissance=$_POST['puissance'];
  };
  
  $ManagerProjet->update_trajet($idTrajet,$debit,$rugosite,$temperature,$type,$sens,$CoteDepart,$PerteCharge,$CoteArrivee,$hauteur,$puissance);

?>
