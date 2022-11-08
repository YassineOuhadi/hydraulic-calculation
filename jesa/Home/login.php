<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="../images/logo3.jpg" rel="icon">
     <link href="../images/logo3.jpg" rel="apple-touch-icon">
	<link rel="stylesheet" href="css/login.css">
	<title>Se Connecter</title>
</head>
<body>

	<div class="form-wrapper">
		<h2 class="form-title">Authentication</h2>
		<p class="form-detail">Connectez-vous à votre compte Jesa avec votre adresse e-mail et votre mot de passe.</p>
		<form action="connection.php" method="post">
			<div class="form-group">
				<label for="email" class="required">Adresse email</label>
				<input type="email" name="email" id="email" placeholder="example@example.com" required>
			</div>
			<div class="form-group">
				<label for="password" class="required">Mot de passe</label>
				<input type="password" id="password" name="password" placeholder="Your password" required>
			</div>
			<div class="mb-4">
				<a href="#" class="form-link">Mot de passe est oublié?</a>
			</div>
			<button type="submit" class="btn btn-blue mb-4">Se Connecter</button>
			<p>Si vous ne l'avez pas, vous pouvez le créer? <a href="register.php" class="form-link">S'inscrire</a></p>
		</form>
	</div>
	

	<script src="js/script.js"></script>
</body>
</html>