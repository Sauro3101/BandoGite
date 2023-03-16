<?php
// Start the session
      session_start();
      if (!isset($_SESSION['email'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
        header('Location: login.php');
        exit;
      }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registrazione</title>
	<link rel="stylesheet" type="text/css" href="Stylesheets/registrazione.css">
  <link rel="icon" href="Immagini/fav-icon.png" type="image/png">
</head>
<body>
  <div class="navbar">
    <div class="menu">
      <a href="gestione_utenti.php">Gestione utenti</a>
      <a href="gestione_progetti.php">Gestione progetti</a>
    </div>
    <div class="logout">
      <a href="logout.php">Logout</a>
    </div>
  </div>
	<div class="form-container">
		<h1>Registrazione</h1>
		<form method="post" action="backend/registra_utente.php">
			<label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" required>

            <label for="cognome">Cognome:</label>
            <input type="text" id="cognome" name="cognome" required>

			<label for="email">Email:</label>
			<input type="mail" id="email" name="email" required>
            <p>Per la registrazione è <b>obbligatorio</b> l'utilizzo di una mail appartenente al dominio <i>iisfalcone-righi.edu.it</i>, in caso contrario non si potrà ricevere la password per accedere al proprio account.</p>
            <p class="centra">Hai bisogno di assistenza? <a href="mailto:museoScuolaVirtuale@gmail.com">Contattaci</a> per avere supporto.</p>
			
			<div class="right">
				<input type="submit" value="Invia">
			</div>
		</form>
	</div>
</body>
</html>
