<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>Document</title>
</head>

<body>
	<header>
		<section id="tete">
			<div id="logotitre">
				<img id="logo" src="logo.png" alt="">
				<h1 class="vraititre">ShadowCom</h1>
			</div>
			<nav>
				<ul>
					<li class="navigation"><a href="#Présentation">Présentation</a></li>
					<li class="navigation"><a href="#Comment">Fonctionnement</a></li>
					<li class="navigation"><a href="#Pourquoi">Pourquoi ?</a></li>
					<li class="navigation"><a href="#Rejoindre">Rejoins-nous</a></li>
				</ul>
			</nav>

		</section>
	</header>
	<main>
		<section id="Présentation">
			<h2 id="">Qui somme nous ?</h2>

			<p>ShadowCom est une agence secrète (enfin, presque) qui aide les espions à communiquer en toute discrétion.
				Notre mission : préserver vos informations secrètes et confidentielles."
			</p>
		</section>

		<section id="Comment">
			<h2>Comment ca marche ?</h2>
			<p>Rejoignez ShadowCom et accédez à notre plateforme de communication sécurisée.
				Chaque message est chiffré via un code César pour garantir la confidentialité de vos échanges.
			</p>
		</section>

		<section id="Pourquoi">
			<h2>Pourquoi choisir ShadowCom ?</h2>
			<div class="tout">
				<div class="raison">
					<img class="imgRaison" src="sécurité.png" alt="">
					<h3>Sécurité maximale</h3>
					<p>Nous utilisons un chiffrement de pointe pour protéger vos échanges.</p>
				</div>
				<div class="raison">
					<img class="imgRaison" src="communication.jpg" alt="">
					<h3>Communication en temps réel</h3>
					<p>Profitez d'un chat sécurisé et instantané.</p>
				</div>
				<div class="raison">
					<img class="imgRaison" src="confidentialité.png" alt="">
					<h3>Confidentialité assurée</h3>
					<p>Vos données sont protégées, vos conversations restent privées.</p>
				</div>
			</div>
		</section>

		<section id="Rejoindre">
			<h2>Prêt à nous rejoindre ?</h2>
			<p>Rejoignez notre plateforme sécurisée et commencez à communiquer de manière confidentielle. N'attendez plus, Cachez-vous !!!</p>
			<div id="call">
				<a href="inscription.php" class="button">S'inscrire</a>
				<a href="connexion.php" class="button">Se connecter</a>
			</div>
		</section>

		<div id="cookie-banner">
        <p>🍪 ShadowCom utilise des cookies pour garantir la sécurité de vos échanges et améliorer votre expérience. 
            <a href="politique-confidentialite.php">En savoir plus</a>
        </p>
        <button id="accept-cookies">Accepter</button>
        <button id="decline-cookies">Refuser</button>
        </div>

	<script>
        document.addEventListener("DOMContentLoaded", function() {
            const banner = document.getElementById("cookie-banner");
            const acceptBtn = document.getElementById("accept-cookies");
            const declineBtn = document.getElementById("decline-cookies");

            // Vérifie si l'utilisateur a déjà donné son choix
            if (localStorage.getItem("cookiesAccepted") !== null) {
                banner.style.display = "none";
            }

            // Accepter les cookies
            acceptBtn.addEventListener("click", function() {
                localStorage.setItem("cookiesAccepted", "true");
                banner.style.display = "none";
            });

            // Refuser les cookies
            declineBtn.addEventListener("click", function() {
                localStorage.setItem("cookiesAccepted", "false");
                banner.style.display = "none";
            });
        });
    </script>

	</main>
	<footer>
		<p>&copy; 2025 ShadowComm - Tous droits réservés.</p>
		<p><a href="#">Politique de confidentialité</a> | <a href="#">Conditions d'utilisation</a></p>
	</footer>

</body>

</html>