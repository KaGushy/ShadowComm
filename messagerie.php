<?php
require_once 'config.php';
session_start();
if (isset($_POST['delete_account'])) {
    require_once 'config.php';
    if (isset($_SESSION['username'])) {
        $stmt = $dbh->prepare('SELECT id FROM users WHERE username = :username');
        $stmt->execute(['username' => $_SESSION['username']]);
        $user = $stmt->fetch();

        if ($user) {
            $userId = $user['id'];
            $stmt = $dbh->prepare('DELETE FROM messages WHERE sender_id = :user_id');
            $stmt->execute(['user_id' => $userId]);
            $stmt = $dbh->prepare('DELETE FROM users WHERE id = :user_id');
            $stmt->execute(['user_id' => $userId]);
            session_destroy();
            header("Location: inscription.php?account_deleted=1");
            exit();
        }
    }
}

if (!isset($_SESSION['username'])) {
    die("Vous devez être connecté pour voir les messages.");
}

function cipherMessage($message, $shift) {
    $result = "";
    $shift = $shift % 26; 
    for ($i = 0; $i < strlen($message); $i++) {
        $char = $message[$i];
        if (ctype_alpha($char)) {
            $ascii = ord($char);
            $base = ctype_upper($char) ? 65 : 97;
            $result .= chr(($ascii - $base + $shift) % 26 + $base);
        } else {
            $result .= $char;
        }
    }
    return $result;
}

function decipherMessage($message, $shift) {
    return cipherMessage($message, 26 - $shift); 
}
$stmt = $dbh->prepare('
    SELECT message.content, message.timestamp, users.username 
    FROM messages AS message
    JOIN users ON message.sender_id = users.id
    ORDER BY message.timestamp DESC
');
$stmt->execute();
$messages = $stmt->fetchAll();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send']) && isset($_SESSION['username'])) {
    $content = htmlspecialchars(trim($_POST['content']));
    $stmt = $dbh->prepare('SELECT id FROM users WHERE username = :username');
    $stmt->execute(['username' => $_SESSION['username']]);
    $user = $stmt->fetch();

    if ($user) {
        $encryptedContent = cipherMessage($content, 3);
        $sth = $dbh->prepare('INSERT INTO messages (sender_id, content) VALUES (:user_id, :content)');
        $sth->execute([
            'user_id' => $user['id'],
            'content' => $encryptedContent,
        ]);

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
	if (isset($_GET['logout'])) {
		session_destroy();
		header("Location: connexion.php");
		exit();
	}
}
?>
<h2>Messages :</h2>
<?php foreach ($messages as $message): ?>
    <div>
        <b><?php echo htmlspecialchars($message['username']); ?> :</b>
        <p><b>Chiffré :</b> <?php echo htmlspecialchars($message['content']); ?></p>
        <p><b>Déchiffré :</b> <?php echo htmlspecialchars(decipherMessage($message['content'], 3)); ?></p>
        <small>Posté le <?php echo $message['timestamp']; ?></small>
    </div>
    <hr>
<?php endforeach; ?>

<form method="post" action="">
    <textarea name="content" placeholder="Écrivez votre message ici..." required></textarea>
    <button type="submit" name="send">Envoyer</button>
</form>
<form method="post" action="messagerie.php" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');">
    <button type="submit" name="delete_account" class="delete-btn">Supprimer mon compte</button>
</form>


