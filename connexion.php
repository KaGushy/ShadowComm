<form action="connexion.php" method="post">
<?php if (isset($message)): ?>
            <p class="error-message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

  <div class="inscrit">	
     
	<label for="pseudo">Nom de code</label>
	<input type="text" name="pseudo" id="pseudo" required placeholder="Nom de code">
     
	<label for="password">mots de passe</label>
	<input type="password" name="password" id="password" required placeholder="Mots de passe">

	<button type="submit" name="connect">connexion</button>
	<div class="link">
            <a href="inscription.php">vous etes pas inscrit ?</a>
        </div>
  </div>
</form>

<?php
	require_once 'config.php'; 
	session_start();

	$message = ""; 

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connect'])) {
		
		if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
			$username = htmlspecialchars(trim($_POST['pseudo']));
			$password = htmlspecialchars(trim($_POST['password']));

			
			$stmt = $dbh->prepare("SELECT * FROM `users` WHERE `username` = :pseudo");
			$stmt->execute(['pseudo' => $username]);
			$user = $stmt->fetch();

			
			if ($user && password_verify($password, $user['password'])) {
				$_SESSION['username'] = $user['username'];
				$message = "<b>Connexion réussie !</b>";
				header('Location: messagerie.php');
				exit(); 
			} else {
				$message = "<b>Nom d'utilisateur ou mot de passe incorrect.</b>";
			}
		} else {
			$message = "<b>Veuillez remplir tous les champs.</b>";
		}
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		header('Location: login.php');
		exit;
	}
	?>