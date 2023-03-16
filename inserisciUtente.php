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
	<title>Nuovo Progetto</title>
	<link rel="stylesheet" type="text/css" href="Stylesheets/InserisciUtente.css">
  <link rel="icon" href="Immagini/fav-icon.png" type="image/png">
</head>
<body>
  <div class="navbar">
    <div class="menu">
      <a href="gestione_utenti.php">Gestione utenti</a>
      <a href="gestione_progetti.php">Gestione progetti</a>
    </div>
    <div class="logout">
      <a href="backend/logout.php">Logout</a>
    </div>
  </div>
	<div class="form-container">
		<h1>Nuovo Utente</h1>
		<form method="post" action="backend/inserisci_utente.php">
			<label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" required>

            <label for="cognome">Cognome:</label>
            <input type="text" id="cognome" name="cognome" required>

			<label for="email">Email:</label>
			<input type="mail" id="email" name="email" required>

			<label for="password">Password:</label>
			<input type="text" id="password" name="password" required>
	  		
			<input type="submit" value="Invia">
		</form>
	</div>
</body>
</html>
