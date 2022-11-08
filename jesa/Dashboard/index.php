<?php 

include_once '../include/Classes.php';

$bdd=fct_bdd();

session_start();

if(!isset($_SESSION['account'])){
    header("location:http://localhost/jesa/Home/login.php");
}

$account=$_SESSION['account'];
$ManagerProjet = new ManagerProjet($bdd);

if(isset($_POST['annuler'])){
    unset ( $_POST ) ;
}
elseif(isset($_POST['valider'])){
    $id_projet=$_GET['projet'];
    $name=$_POST['name'];
$ManagerProjet->fct_insert_trajet($id_projet,$name,$_POST['debit'],$_POST['rugosite'],$_POST['temperature'],$_POST['depart'],$_POST['type'],$_POST['sens']);
    header('HTTP/1.1 303 See Other');
    header("Location:index.php?projet=$id_projet");
}
elseif(isset($_POST['btn_NewProjet'])){
    $bb=$_POST['new_ligne'];
    $id=$ManagerProjet->fct_insert_projet($account->idCompte,$bb);
    header('HTTP/1.1 303 See Other');
    header("location:http://localhost/jesa/Dashboard/index.php?projet=$id");
};

$id_projet=0;
$page=0;
if(isset($_GET['projet'])){
    $id_projet=$_GET['projet'];
    
       if(isset($_GET['nouveau'])){
           $page=3;
        }else{
           $page=2;
       };
        
        
}
else{
    $page=1;
};

if(($page==2)||($page==3)){
    
$row=$ManagerProjet->fct_find_projet($id_projet);
    
$projet = ClasseProjet::construct2($row);
    
$nb_trajets=$ManagerProjet->fct_find_count_trajets($id_projet);
 
require('fct.php');      
    
};
?>
<html lang="en">
<head>
	 <meta charset="UTF-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="../images/logo3.jpg" rel="icon">
     <link href="../images/logo3.jpg" rel="apple-touch-icon">
	 <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
     <link href='//fonts.googleapis.com/css?family=Roboto:100,400,300' rel='stylesheet' type='text/css'>
     <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="../src/style.css">
     <link rel="stylesheet" href="css/style.css">
     <link rel="stylesheet" href="../Dashboard2/array.css">
	 <title>
     <?php 
        if($page==1){echo $account->username;}
        else{echo $projet->titre;};
     ?>
     </title>
</head>
<style>
<?php if($page==1){?>
body{
    overflow:auto;
} 
body{
    background-image: url(images/bg.png);
    background-size: cover;
}
.btn-download a{
    color: white;
}
.top_nav{
    background:inherit;
    border:none;
}
nav .toggle-sidebar{
    color:white;
}
<?php ;}
else if(($page==2)||($page==3)){?>
body{ 
    overflow: hidden;
    background-color:white;
    position: fixed;
    width:100%;
    height:100%;
}
main{
    background-color:white;
}
.btn-download a{
    color: black;
}
input[type=number]{
    width:50%;
    font-size: 12px;
}    
input[type=number]::-webkit-inner-spin-button {
    display: none;  
} 
input,select:focus {
    outline: none;
    outline-style: none;
    box-shadow: none;
    border-color: transparent;
    border-bottom-color: black;
}
label,input,option,select{
    max-width:250px;
   font-size: 14px;
   color: black;border-color: black;
}
<?php ;};?>   
</style>
<body oncontextmenu="return false;">
    
    <input type="hidden" id="page" value="<?php echo $page; ?>">
    
    <div id="context-menu">
      <div class="item">
        <i class='bx bx-folder-open'></i>
        <label id="edit_projet_name"></label>
      </div>
      <hr>
      <div class="item">
        <a class="EditProjet"><input type="hidden" value="0" id="edit_projet_id"><i class='bx bx-edit' ></i>Editer</a>
      </div>
      <div class="item">
        <a class="DeleteProjet"><input type="hidden" value="0" id="delete_projet_id"><i class="fa fa-trash" aria-hidden="true"></i>Supprimer</a>
      </div>
    </div>
    
	<!-- SIDEBAR -->
    <?php require('../include/sidebar.php')?>
	<!-- SIDEBAR -->
	<section id="content">
		<!-- NAVBAR -->
        <?php require('../include/topnav.php')?>
		<!-- NAVBAR -->
     	<!-- MAIN -->
        <main> 
            <div id="box">
			<div class="body">
				Nouvelle Ligne d'eau
			</div>
		    </div>
            <?php if($page==1){ ?>
            <style>
               .data{
                display: flex;
                min-height:100vh;
                align-items: center;
                justify-content: center;
                height:100%;     
                }
                .nv_projet{
                margin-top:-10%;
                background-color:inherit;    
                }
            </style>
            <div class="data">
                <div class="nv_projet">
		          <div class="ads">
			      <div class="wrapper1" id="new_projet">
                      <button class="btn-upgrade" onclick="add();" style="width:100%;margin-bottom:10px;">Nouveau Projet</button>
				      <p>Effectuez vos <span>Calculs</span> de manière <span> Simple</span> et <span> Rapide</span></p>
			      </div>
                  <div class="wrapper1" id="input_new_projet">
                      <form action="index.php" method="post">
                      <input type="text" name="new_ligne" id="new_ligne" value="Nouveau Projet" onClick="this.select();" required>
                      <button type="submit" class="btn" id="btn_NewProjet" name="btn_NewProjet" style="width:100%;">Valider</button>
                      </form>
                  </div>
		          </div> 
	            </div>
                <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#fff" fill-opacity="1" d="M0,128L80,160C160,192,320,256,480,250.7C640,245,800,171,960,154.7C1120,139,1280,181,1360,
                202.7L1440,224L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
                </path>
                </svg>
            </div>
            <?php ;}
            elseif(($page==2)||($page==3)) { ?>
            <style>
                .text.titre{
                    color:black;
                }
            </style>
            <input type="hidden" id="id_projet" value="<?php echo $id_projet; ?>">
            <div class="head-title" style="margin-top:0;">
                <div class="left" style="background:inherit;margin-top:0;">
                    <a href="#" class="btn-download" style="position:absolute;left:10px;">
					    <span class="text titre" style="font-size:18px;font-family: Geneva, Verdana, sans-serif;"><?php echo $projet->titre ;?></span>
				    </a>
                    <?php if($page==3) { ?>
                    <a href="#" class="btn-download" style="position:absolute;left:10px;top:125px;">
                      <span class="text titre" style="font-size:15px;font-family: 'Courier New', monospace;">Création d'un Nouvelle Ligne d'eau</span>
				    </a>
                    <?php ;}; ?>
                    <?php if($page==2) { ?>
                    <div style="width:100%;position:fixed;right:10px;text-align: right;">
					<a href="index.php?projet=<?php echo $id_projet ;?>&nouveau" class="button-26" id="new">
					    <span class="text">Nouvelle ligne d'eau</span>
				    </a>
                    <div id="edit">
                        <button class="button-26" id="annuler" style="background-color:white;color:#1652F0;border:1px solid #1652F0;">Annuler</button>
                        <button class="button-26" style="margin-left:20px;" id="supprimer">Supprimer</button>
                    </div>
                    </div>
                    <?php ;}; ?>
				</div>
            </div>
            <?php if($page==3){ ?>
            <div class="data" style="display:flex;min-height:120vh;align-items: center;justify-content: center;height:100%;width:100%;">
            <div class="nv_projet" style="background-color:inherit;width:100%;height:100%;">
		    <div class="container" style="top:185px;background-color:white;">
            <form action="index.php?projet=<?php echo $id_projet ;?>" method="post" class="form" autocomplete="off">
                <fieldset>
                      <div class="field">
                        <label>Nom de la ligne</label>
					    <input type="text" id="name" name="name" value="Nouvelle Ligne" onClick="this.select();" required>
                      </div>
                      <div class="field">
                        <label for="type">Type de la ligne d'eau</label>
					    <select name="type">
                             <option value="Gravitaire" >Gravitaire</option>
                             <option value="Refoulement">Refoulement</option>  
                        </select>
                      </div>
                      <div class="field">
                        <label for="sens">Sens du Calcul</label>
					     <select name="sens">
                             <option value="Amont-Aval" >Amont-Aval</option>
                             <option value="Aval-Amont">Aval-Amont</option>  
                         </select>
                      </div>
                      <div class="field">
                        <label for="depart">Cote de départ (m)</label>
					    <input type="number" min="0" step="any" value="400" name="depart" oninput="validity.valid||(value='');" required >
                      </div>
                      <div class="field">
                        <label for="debit">Débit (mm)</label>
					    <input type="number" min="0" step="any" value="400" name="debit" oninput="validity.valid||(value='');" required>
                      </div>
                      <div class="field">
                        <label for="rugosite">Rugosité</label>
					    <input type="number" min="0" step="any" value="1" name="rugosite" oninput="validity.valid||(value='');" required>
                      </div>
                      <div class="field">
                        <label for="temperature">Temperature (C)</label>
					    <input type="number" min="0" step="any" value="10" name="temperature" oninput="validity.valid||(value='');" required>
                      </div>
                      <div class="actions" style="margin-top:25px;">
                        <button type="submit" class="btn" id="submit" name="valider">Valider</button>
                        <div id="feedback" class="form__feedback" aria-live="assertive" role="alert"></div>
                      </div>
                    </fieldset>
            </form>
	        </div>
	        </div>
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#fff" fill-opacity="1" d="M0,128L80,160C160,192,320,256,480,250.7C640,245,800,171,960,154.7C1120,139,1280,181,1360,
            202.7L1440,224L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
            </path>
            </svg>
            </div>
            <?php }else if(($page==2)&&($nb_trajets!=0)){?>
            <div class="data" style="position:absolute;top:100%;width:100%;height:100%;background:white;">
            <div class="content-data" style="height:535px;" id="costum-data">
					<table style="border-collapse: collapse; " id="trajets">
				        <thead>
				            <tr>
                                <td style="box-shadow:none;"></td>
								<td style="color:black;box-shadow:none;">Nom du trajet</td>
                                <td style="color:black;box-shadow:none;">Type d'écoulement</td>
                                <td style="color:black;box-shadow:none;">Sens du calcul</td>
                                <td style="color:black;box-shadow:none;">cote de départ (m)</td>
								<td style="color:black;box-shadow:none;">Perte de charge (m/m)</td>
                                <td style="color:black;box-shadow:none;">cote d'arrivée (m)</td>
                                <td style="box-shadow:none;"></td>
				            </tr>
				        </thead>
						<tbody style="margin-top:5px;">
                            <?php 
                            $k=0;
                            foreach($trajets as $trajet){
                                $k=$k+1;
                                $count=count($trajet->pieces);
                                ?>
				                <tr onclick="move();" onchange="check();" id="tr<?php echo $k; ?>">
                                    <input type="hidden" value="<?php echo $trajet->idTrajet; ?>" id="id_trajet" >
                                    <td><input type="checkbox" value="<?php echo $trajet->idTrajet; ?>"></td>
									<td style="color:black;"><?php echo $trajet->nom; ?></td>
                                    <td style="color:black;"><?php echo $trajet->type;?></td>
                                    <td style="color:black;"><?php echo $trajet->sens;?></td>
                                    <td style="color:black;"><?php echo $trajet->cote_depart;?></td>
                                    <td style="color:black;"><?php echo $trajet->perte_charge;?></td>
                                    <td style="color:black;"><?php echo $trajet->cote_arrivee;?></td>
                                    <td>
                                        <a href="../Dashboard2/index.php?i=<?php echo $trajet->idTrajet; ?>" class="button-26" role="button">Plus
                                        </a>
                                    </td>	
								</tr>
                                <?php ;}; ?>
				        </tbody>
				    </table>
            </div>
            </div>
            <?php ;}; ?>
            <?php ;}; ?>
        </main>
        <?php require('../include/wrapper.html')?>
    </section>
    <!-- Script -->
<script src="../jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="../js/script.js"></script>
<?php require('js/script.php')?>
<script>
     window.addEventListener('load', function () {
	 document.body.classList.add('hide');
         document.getElementById('sidebar').classList.toggle('hide');
     });
    
     <?php for ($k = 0; $k < $total; $k++){ ?> 
    document.getElementById("projet<?php echo $k; ?>").addEventListener("contextmenu",function(event){
         event.preventDefault();
         <?php for ($l= 0; $l < $total; $l++){ ?> 
         document.getElementById("projet<?php echo $l; ?>").classList.remove("edit");
         <?php ;}; ?>
         document.getElementById("projet<?php echo $k; ?>").classList.add("edit");
         var name=document.querySelector('#projet<?php echo $k; ?> #name').value;
         var id=document.querySelector('#projet<?php echo $k; ?> #id').value;
         document.querySelector('#context-menu #edit_projet_name').innerHTML=name; 
         document.querySelector('#context-menu #delete_projet_id').value=id;
         document.querySelector('#context-menu #edit_projet_id').value=id;
         var contextElement = document.getElementById("context-menu");
         contextElement.style.top = window.event.y + "px";
         contextElement.style.left = window.event.x + "px";
         contextElement.classList.add("active");
    });
    <?php ;}; ?>
        
    window.addEventListener("click",function(){
      <?php for ($k = 0; $k < $total; $k++){ ?> 
      document.getElementById("projet<?php echo $k; ?>").classList.remove("edit");
      <?php ;}; ?>
      document.getElementById("context-menu").classList.remove("active");
    });
    
</script>
    <!-- Script -->
<script type="text/javascript">
    function fct(){
       document.getElementById('box').style.display = 'block';
       setTimeout(() => {
      const box = document.getElementById('box');
      box.style.display = 'none';
      },2000); // 👈️ time in milliseconds
    };
</script>
</body>
</html> 

