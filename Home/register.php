<?php
include_once '../include/Classes.php';
$bdd=fct_bdd();
$ManagerProjet = new ManagerProjet($bdd);
if(isset($_POST['inscrire'])){
    $img="";
    $password=$_POST['password'];
    $second_password=$_POST['second_password'];
    $email=$_POST['email'];
    $pseudo=$_POST['pseudo'];
    if(isset($_FILES['photo']['name']))
    {
        $img= $_FILES['photo']['name'];
        $tmp=$_FILES['photo']['tmp_name'];
        move_uploaded_file($tmp,"../Dashboard/images/".$img);
    };
    if($password==$second_password)
    {            
        $ManagerProjet->fct_create_account($email,$pseudo,$img,$password);
        header('HTTP/1.1 303 See Other');
        header("location:http://localhost/jesa/home/login.php");
    }
    else
    {
        echo "<script>alert('Modifier ou réinitialiser votre mot de passe');</script>";  
    };
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../images/logo3.jpg" rel="icon">
     <link href="../images/logo3.jpg" rel="apple-touch-icon">
	<link rel="stylesheet" href="css/login.css">
	<title>S'inscrire</title>
</head>
<style>
.input-file{
    background-color: #f8f9fc;
    border: 1px solid #e2e9f3;
    border-radius: 4px;
    width: 500px;
    color: #565A90;
}
.input-file::file-selector-button{
    border: none;
    border-radius: 4px;
    background-color: #fff;
    color: #565A90;
    transition: all .25s ease-in;
    border: 1px solid #595ef1bd;
    height: 40px;
    cursor: pointer;
    transition: all .25s ease-in;
    cursor: pointer;
}
.input-file::file-selector-button:active {
  transform: scale(0.95);
}
</style>
<body>
	<div class="form-wrapper">
		<h2 class="form-title">Inscription</h2>
		<p class="form-detail">Créer votre compte, vous pouvez effectuer vos Calculs hydrauliques de manière Simple et Rapide.</p>
		<form action="register.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="email" class="required">Adresse email</label>
				<input type="email" id="email" name="email" placeholder="example@example.com" required>
			</div>
			<div class="form-group">
				<label for="pseudo" class="required">Pseudo</label>
				<input type="text" id="pseudo" name="pseudo" required>
			</div>
			<div class="form-group">
				<label for="password" class="required">Mot de passe</label>
				<input type="password" id="password" name="password" required>
			</div>
			<div class="form-group">
				<label for="second_password" class="required">Confirmer votre mot de passe</label>
				<input type="password" id="second_password" name="second_password" required>
			</div>
            <div class="form-group">
				<label for="image">Photo</label>
				<input type="file" id="photo" name="photo" class="input-file" style="background-color:white;" accept="image/*">
			</div>
			<button type="submit" class="btn btn-blue mb-4" name="inscrire" id="inscrire">S'inscrire</button>
			<p>Vous avez déjà un compte? <a href="login.php" class="form-link">Se connecter</a></p>
		</form>
	</div>
	<script src="js/script.js"></script>
</body>
</html>