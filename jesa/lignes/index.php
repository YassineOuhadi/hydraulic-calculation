<?php 
$nb=0;
include_once '../include/Classes.php';

$bdd=fct_bdd();

session_start();

if(!isset($_SESSION['account'])){
    header("location:http://localhost/jesa/Home/login.php");
}

$account=$_SESSION['account'];

$ManagerProjet = new ManagerProjet($bdd);

$id_trajet=$_GET['i']; 

/*
if(isset($_POST['ajouter'])){
   $ManagerProjet->insert();
    header('HTTP/1.1 303 See Other');
    header("Location:index.php?id_trajet=$id_trajet");
}
*/
$id_projet=0;

$row=$ManagerProjet->fct_find_by_idTrajet($id_trajet);

$pieces = array();

$select_pieces=$ManagerProjet->fct_find_pieces($id_trajet);

foreach($select_pieces as $row_pieces){
    $piece = ClassePiece::construct2($row_pieces); 
    array_push($pieces,$piece);
}

$trajet = ClasseTrajet::construct2($row,$pieces);

$row=$ManagerProjet->fct_find_projet($trajet->idProjet);

$projet= ClasseProjet::construct2($row);

$id_projet=$projet->idProjet;

$count_choix=count($trajet->pieces);

$a= 0;
$l=0;
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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <link rel="stylesheet" href="css/style.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<title><?php echo $trajet->nom;?></title>
</head>     
<style>

</style>
<body oncontextmenu="return false;" >
    
    
    
	<!-- SIDEBAR -->
	<?php require('../include/sidebar.php')?>
	<!-- SIDEBAR -->
	<section id="content">
		<!-- NAVBAR -->
		<?php require('../include/topnav.php')?>
		<!-- NAVBAR -->
		<!-- MAIN -->
		<main>
            
            <div class="head-title" >
				<div class="left">
					<a href="../projets/index.php?projet=<?php echo $id_projet; ?>"><h1 id="projet"></h1></a>
					<ul class="breadcrumb">
				        <li>
                             <a id="trajet" href="#"></a>
                        </li>
					</ul>                    
                    <div style="color:#F2F2F2;" class="result"></div>
				</div>
                <div class="left" style="position:absolute;right:15px;">
				<a class="button btn-download" onclick="save();" style=" 
                                                                width: 100%;padding-top:2px;
                                                                text-align:right;
                                                                text-transform: uppercase;
                                                                transition: 0.5s;
                                                                background-size: 200% auto;
                                                                border-radius: 5px;
                                                                display: block;
                                                                font-weight: 700;
                                                                cursor: pointer;
                                                                user-select: none;
                                                                -webkit-user-select: none;
                                                                ">
                <ul style="text-align:right;">
                <li style="text-align:right;">Enregistrer</li>
                </ul>
                </a>	
				</div>
			</div>
            
            <div class="head-title box" style="height:auto;">
                <div class="box" id="box1">
			         <div class="body"></div>
		        </div>
            </div>
            
            <div class="head-title" style="height:auto;padding-top:0;padding-bottom:0;padding-top:20px;">
                
				<div id="left">
				  <fieldset id="fieldset">
                    <legend>Type d'Écoulement</legend>
                    <div class="form-group">
                    <input  autocomplete="off" role="combobox" list="" id="type" name="list">
                    <datalist id="list" role="listbox" >
                    </datalist>  
                    </div>
                  </fieldset>	
				</div>
                
                <div class="first">
                <fieldset>
                    <legend>
                       Sens de Calcul
                    </legend>
                     <div class="form-group cache" id="modifier">
                     <select name="nom" size="2" id="hanane">
                         <option value="Amont-Aval" id="Amont-Aval">Amont-Aval</option>
                         <option value="Aval-Amont" id="Aval-Amont">Aval-Amont</option>
                     </select>
				     </div>              
                    </fieldset>
                </div>
                
			</div>
            
            
            
            
            
            <div class="data" id="top_content-data" style="margin-top:10px;">
            <div class="content-data">
                
                <div class="pricing-wrapper">
                    
                    
                  
                    
			       <div class="pricing-box">
				   <ul class="features">
				   <li>   
                     <div class="form-group cache" id="modifier">
                     <input id="label" placeholder="Débit  (l/s)"  readonly>
                     <input id="debit" type="number" value="" min="0" step="any">
				     </div>
                   </li>
				   <li> 
                     <div class="form-group cache" id="modifier">
                     <input id="label" placeholder="Cote de départ (m)" readonly>
                     <input id="cote_depart" type="number" value="" min="0" step="any">
				     </div>               
                   </li>
				   </ul>
			       </div>
                    
                   <div class="pricing-box">
				   <ul class="features">
				   <li> 
                     <div class="form-group cache" id="modifier">
                     <input id="label" placeholder="Rugosité  (mm)" readonly>
                     <input id="rugosite" type="number" value="" min="0" step="any">
				     </div>              
                   </li>
				   <li> 
                     <div class="form-group">
                     <input id="label" placeholder="Perte de charge (m/m)" readonly>
                     <input id="perte_charge" class="block" type="number" value="" min="0" step="any" readonly>
				     </div>               
                   </li>
				   </ul>
			       </div>
                    
                   <div class="pricing-box">
				   <ul class="features">
				   <li> 
                     <div class="form-group cache" id="modifier">
                     <input id="label" placeholder="Température (°C)" readonly>
                     <input id="temperature" type="number" value="" min="0" step="any" >
				     </div>               
                   </li>
				   <li> 
                     <div class="form-group  cache">
                     <input id="label" placeholder="Cote d'arrivée (m)" readonly>
                     <input id="cote_arrivee"  type="number" value="" min="0" step="any">
				     </div>               
                   </li>
				   </ul>
			       </div>
                    
                   
                    
                   <div id="refoulement">
			       <div class="pricing-box">
				   <ul class="features">
				   <li>   
                     <div class="form-group cache" id="modifier">
                      <input id="label" placeholder="Hauteur manométrique (m)" readonly>
                     <input id="hauteur"  type="number" value="" min="0" step="any" readonly>
				     </div>
                   </li>
                    <li> 
                     <div class="form-group cache" id="modifier">
                     <input id="label" placeholder="Puissance de la pompe (watts)" readonly>
                     <input id="puissance"  type="number" value="" min="0" step="any" readonly>
				     </div>              
                   </li>
				   </ul>
			       </div>
                   </div>
                    
                   <div class="pricing-box" style="height:300px;background: url(../lignes/images/hh.png);background-size:cover;"></div>
                    
                   <div class="pricing-box">
				   <ul class="features">
				   <li> 
                     <div class="form-group" id="custum_btn">
                     <a class="btn">Valider</a>
				     </div>               
                   </li>
				   </ul>
			       </div>
                    
		       </div> 
               <svg class="curveUpColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 C 20 0 50 0 100 100 Z"></path>
               </svg>
            </div>
            </div>
            
            
            <!--<nav class="data_nav top" style="background:white;">
                <ul>
                <li id="right_li">
                             <a href="#" class="btn-fixed">
                                 <i class='bx bx-list-plus' ></i>
					             <span class="text">Nouveau Trajet</span>
				             </a>
                </li>
                </ul>
                
            </nav>-->
            
            <nav class="data_nav main" style="margin-top:20px;">
            <ul>
                <li onclick="all_cardes();" class="active" id="li_all"><a href="#">TOUS LES ELEMENTS</a></li>
                <li onclick="droits();" id="li_droits"><a href="#">ELEMENTS DROITS</a></li>
                <li onclick="vannes();" id="li_vannes"><a href="#">VANNES ET ROBINETS</a></li>
                <li onclick="coudes();" id="li_coudes"><a href="#">COUDES</a></li>
                <li onclick="cones();" id="li_cones"><a href="#">CONES</a></li>
                <li onclick="changements();" id="li_changements"><a href="#">CHANGEMENTS</a></li>
                <li onclick="tes();" id="li_tes"><a href="#">TÉS</a></li>
                <li onclick="autres();" id="li_autres"><a href="#">Autres</a></li>
            </ul>
            </nav>
            
            <nav class="data_nav box">
                <div class="box" id="box2" style="margin-bottom:12px;">
			      <div class="body"></div>
		        </div>
            </nav>
            
			<div class="info-data">
                
              <div class="horizontal-scroll" id="all" style="height:157px;">
                
                <?php 
                $result=$ManagerProjet->fct_find_all_hh();
                foreach($result as $row){    
                ?>    
                <div class="costum"  style="height:150px;">
				<div class="card" id="card<?php echo $l;?>">
                    <input type="hidden" id="xxxx" value="<?php echo $row['categorie_libelle'];?>">
                    <div id="inner">
                    <img style="height:50px;width: auto;" class="main" id="img0"  src="images/<?php echo $row['image'];?>"/>
					<div class="head">
						<div style=" margin-top:0px;">
							<h2><?php echo $row['nom_piece'];?></h2>
						</div>
					</div>
                    <form action="" method="POST" id="myForm" style=" margin-top:0px;">
                          <input type="hidden" id="id_piece" value="<?php echo $row['id_piece'];?>">
                          <input type="hidden" id="categorie" value="<?php echo $row['categorie_libelle'];?>">
                          <input id="ajouter" name="ajouter" type="submit" value="Ajouter">
                    </form>
				    </div>
                </div>
                </div>
                <?php ;$l=$l+1;};$total_pieces=$l;
                ?> 
                </div>
                
			</div>
            
			<div class="data" id="first_content-data" style="height:auto;background:white;padding-top:0;max-height:450px;">
                
				<div class="content-data" style="border: 1px solid #dddddd;height:500px;background:white;padding:0;border:none;padding-top:20px;height:485px;margin-top:0;padding-bottom:10px;padding-left:0px;">
					<div id="infosWithTable" style="height:100%;width:100%;padding-left:0px;">
                    <div class="todo" style="height:100%;width:100%;padding-left:0px;">
                     
				     <ul class="todo-list">
                     <?php 
                           $k=0;
                           foreach($trajet->pieces as $piece){ 
                           $k=$k+1;};
                               $p=$k; ?>
                     <div class="suite"></div>
                      
                     </ul>
                    </div>
                    </div>
                    <div id="edit" style="width:100%;height:75px;background:white;padding-left:20px;padding-right:20px;margin-top:-55px;padding-top:10px;position:relative;margin-left:auto;margin-right:auto;">
                    <input id="annuler" type="submit" value="Annuler" style="margin-top:0;">
                    <input id="supprimer" type="submit" value="Supprimer" style="margin-top:0;">
                    </div>
				</div>
                   
                <div class="content-data" id="second_content-data" style="width:475x;padding:0;padding-bottom:10px;border:none;height:485px;margin-top:0;padding-top:10px;" >
                    <table style="width:100%;" >
                       <thead style="border:none;border-radius:0;overflow:none;">
                          <tr style="border:none;height:40px;border-radius:0;height:100%;overflow:none;">
                           <td style="box-shadow:none;">Cote de départ</td>
                           <td style="box-shadow:none;">Cote de départ (m)</td>
                           <td style="box-shadow:none;">Perte de charge (m/m)</td>
                           <td style="box-shadow:none;">Cote d'arrivée (m)</td>
                          </tr>
                      </thead>
                      <tbody style="margin-top:5px;">
                          <div id="perte_charge"></div>
                      </tbody>
                    </table>
                </div>
               
			</div>
            
		</main>
        <!-- MAIN -->
	</section>
    <?php require('../include/wrapper.html')?>
    
    <!--script-->
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="../js/script.js"></script>
    <script src="../jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>  
    <?php require('script.php')?>
    <?php require('js/wrapper.php')?>
    <script>
    window.addEventListener('load', function () {
        document.getElementById('sidebar').classList.toggle('hide');
         document.body.classList.add('hide');
	     load();
    });

    
        
        
    
    </script>
    
    <script src="hobi.js"></script>
    
    <script>
    function getRandomColor() {
    var colors = [
                '#FFFFFF', '#FFFAFA', '#F0FFF0',
                '#F8F8FF', '#F5F5F5',
                '#FFFAF0',
                 '#FFFFF0',
                
                '#F0F8FF'
               ];
    return colors[Math.floor(Math.random() * colors.length)];
    };
    
    input=document.getElementById('type');fieldset=document.getElementById('fieldset');
    datalist=document.getElementById('list');       
    input.onfocus = function () {
       datalist.style.display = 'block';
        input.style.display = 'none';
        fieldset.style.border=" 1px solid dodgerblue";
       for (let option of datalist.options) {
         option.onclick = function () {
         input.value = option.value;
         datalist.style.display = 'none';
         fieldset.style.border="none";input.style.display = 'block';
         Edit();
      }
    }; 
    };
        
    hanane=document.getElementById('hanane');
    for (let option of hanane.options) {
     option.onclick = function () {
     Edit();
    }
    }; 

    function recursive_offset (aobj) {
     var currOffset = {
       x: 0,
       y: 0
     } 
     var newOffset = {
         x: 0,
         y: 0
     }    

     if (aobj !== null) {

      if (aobj.scrollLeft) { 
        currOffset.x = aobj.scrollLeft;
      }

      if (aobj.scrollTop) { 
        currOffset.y = aobj.scrollTop;
      } 

      if (aobj.offsetLeft) { 
        currOffset.x -= aobj.offsetLeft;
      }

      if (aobj.offsetTop) { 
        currOffset.y -= aobj.offsetTop;
      }

      if (aobj.parentNode !== undefined) { 
         newOffset = recursive_offset(aobj.parentNode);   
      }

      currOffset.x = currOffset.x + newOffset.x;
      currOffset.y = currOffset.y + newOffset.y; 
      console.log (aobj.id+' x'+currOffset.x+' y'+currOffset.y);
         
      }
        
      return currOffset;
        
      }
        
      var offsetpos = recursive_offset (this); //or some other element

      posX = event.clientX+offsetpos.x;
      posY = event.clientY+offsetpos.y;
  
      </script>
      <!--script-->
<script>

</script>
</body>
</html>