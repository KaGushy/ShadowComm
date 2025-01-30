<link rel="stylesheet" href="">
<form action="inscription.php" method="post">
<?php if (isset($message)): ?>
            <p class="error-message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

  <div class="inscrit">	
     
	<label for="pseudo">Nom de code</label>
	<input type="text" name="pseudo" id="pseudo" required placeholder="Nom de code">
     
	<label for="password">mots de passe</label>
	<input type="password" name="password" id="password" required placeholder="Mots de passe">

	<label for="comfirmer">Comfirmer votre mots de passe</label>
	<input type="password" name="comfirmer" id="comfirmer" required placeholder="Mots de passe">

	<button type="submit" name="register">S'inscrire</button>
	<div class="link">
            <a href="connexion.php">Déjà inscrit ?</a>
        </div>
  </div>
</form>

<?php
require_once 'config.php';
if (isset($_POST['register'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['comfirmer'])) {
        $pseudo = htmlspecialchars(trim($_POST['pseudo']));
        $password = htmlspecialchars(trim($_POST['password']));
        $comfirmer = htmlspecialchars(trim($_POST['comfirmer']));
        if ($password !== $comfirmer) {
            $message = "Les mots de passe sont pas bon kévin !";
        } else {
            $stmt = $dbh->prepare('SELECT COUNT(*) FROM `users` WHERE `username` = :pseudo');
            $stmt->execute(['pseudo' => $pseudo]);
            if ($stmt->fetchColumn() > 0) {
                $message = "Nom de code déjà pris (rajoute un 0 ptet ca marche)!";
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $sth = $dbh->prepare('INSERT INTO `users` (`username`, `password`) VALUES (:username, :password)');
                $sth->execute([
                    'username' => $pseudo,  
                    'password' => $hash,    
                ]);
                header('Location: connexion.php?success=1');
                exit;
            }
        }
    } else {
        $message = "Veuillez remplir tous les champs !";
    }
}
?>

