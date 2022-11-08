<?php

    include_once '../include/Classes.php';
    $bdd=fct_bdd();

	if($bdd){
		$account;
		$connecter=false;
		if(isset($_POST['email']) and isset($_POST['password'])){
			
				$result = $bdd->query('SELECT * from compte');
				foreach($result as $row) {
					if($row['email']==$_POST['email'] and $row['password']==$_POST['password']){
                        
                        
                        
                            $ManagerProjet = new ManagerProjet($bdd);
                            $row['nb_projets']=$ManagerProjet->fct_find_count($row['id_compte']);
					        $account = ClasseCompte::construct2($row);
                        
                               
                                
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
						    $connecter=true; 
                            break;
					}
				}
			if($connecter){
				    session_start();
				    $_SESSION['account'] = $account;
				    header("location:http://localhost/jesa/projets/index.php");
			}
			else{
				$erreur="impossible de se connecter";
				header("location:http://localhost/jesa/Home/login.php?erreur=$erreur");
			}
		}
	}
?>
