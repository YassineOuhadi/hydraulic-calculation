
<?php

include_once '../include/Classes.php';
$bdd=fct_bdd();
$ManagerProjet = new ManagerProjet($bdd);


$CoteDepart=$_POST['CoteDepart'];
$PerteCharge=$_POST['PerteCharge'];
$CoteArrivee=$_POST['CoteArrivee'];
$debit=$_POST['debit'];

  $idPiece=$_POST['idPiece'];
$idTrajet=$_POST['idTrajet']; 
  $categorie=$_POST['categorie'];
$name=$_POST['name'];

  if($categorie=="VANNES ET ROBINETS"){
      $val1=$_POST['val1'];
      $val2=$_POST['val2'];
      $ManagerProjet->insert($debit,$idTrajet,$idPiece,$val1,0,$val2,0,0,0,0,0,$CoteDepart,$PerteCharge,$CoteArrivee);
  }
  else if($categorie=="ELEMENTS DROITS"){
      $d=$_POST['d'];
      $l=$_POST['l'];
      $k=$_POST['k'];
      $ManagerProjet->insert($debit,$idTrajet,$idPiece,$d,0,$k,$l,0,0,0,0,$CoteDepart,$PerteCharge,$CoteArrivee);
  }
  else if($categorie=="COUDES"){
      $d=$_POST['d'];
      $angle=$_POST['angle'];
      
      $k=$_POST['k'];
      
      if($name=="COUDE ARRONDI"){
          $rayon=$_POST['rayon'];
          $ManagerProjet->insert($debit,$idTrajet,$idPiece,$d,0,$k,0,$angle,$rayon,0,0,$CoteDepart,$PerteCharge,$CoteArrivee);
      }
      else if($name=="COUDE BRUSQUE"){
          $ManagerProjet->insert($debit,$idTrajet,$idPiece,$d,0,$k,0,$angle,0,0,0,$CoteDepart,$PerteCharge,$CoteArrivee);
      };
      
  }
  else if($categorie=="CONES"){
      if($name=="CONE CONVERGENT"){
          $k=$_POST['k'];
          $d=$_POST['d'];
          $_D=$_POST['_D'];
          $angle=$_POST['angle'];
          $ManagerProjet->insert($debit,$idTrajet,$idPiece,$d,$_D,$k,0,$angle,0,0,0,$CoteDepart,$PerteCharge,$CoteArrivee);
      }
      else if($name=="CONE DIVERGENT"){
          $k=$_POST['k'];
          $D1=$_POST['D1'];
          $D2=$_POST['D2'];
          $angle=$_POST['angle'];
          $ManagerProjet->insert($debit,$idTrajet,$idPiece,0,0,$k,0,$angle,0,$D1,$D2,$CoteDepart,$PerteCharge,$CoteArrivee);
      };
  }
  else if($categorie=="CHANGEMENTS"){
          $k=$_POST['k'];
          $D1=$_POST['D1'];
          $D2=$_POST['D2'];
          $ManagerProjet->insert($debit,$idTrajet,$idPiece,0,0,$k,0,0,0,$D1,$D2,$CoteDepart,$PerteCharge,$CoteArrivee);
  }
  else if($categorie=="TÉS"){
          $k=$_POST['k'];
          $d=$_POST['d'];
          $_D=$_POST['_D'];
          $ManagerProjet->insert($debit,$idTrajet,$idPiece,$d,$_D,$k,0,0,0,0,0,$CoteDepart,$PerteCharge,$CoteArrivee);
  }
  else if($categorie=="Autres"){
          if(($name=="Départ")||($name=="Arrivée")||($name=="Crépine")){
          $k=$_POST['k'];
          $d=$_POST['d'];
          $ManagerProjet->insert($debit,$idTrajet,$idPiece,$d,0,$k,0,0,0,0,0,$CoteDepart,$PerteCharge,$CoteArrivee);    
          }
          else if($name=="Débitmètre"){
          $k=$_POST['k'];
          $d=$_POST['d'];
          $l=$_POST['l'];  
          $ManagerProjet->insert($debit,$idTrajet,$idPiece,$d,0,$k,$l,0,0,0,0,$CoteDepart,$PerteCharge,$CoteArrivee);
          };
          
  };

?>
