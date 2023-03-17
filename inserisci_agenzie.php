<?php
// Start the session
      session_start();
      if (!isset($_SESSION['username'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
        header('Location: login.php');
        exit;
      }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nuovo Progetto</title>
	<link rel="stylesheet" type="text/css" href="Stylesheets/InserisciProg.css">
  	<link rel="icon" href="Immagini/fav-icon.png" type="image/png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
</head>
<body>
	<div class="navbar">
    <div class="menu">
      <a href="menu.php">Menu</a>
      <a href="gestione_offerte.php">Gestione offerte</a>
      <a href="gestione_viaggi.php">Gestione viaggi</a>
      <a href="gestione_agenzie.php">Gestione agenzie</a>
    </div>
		<div class="logout">
			<a href="backend/logout.php">Logout</a>
		</div>
	</div>
	<div class="form-container">
		<h1>Nuovo viaggio</h1>
		<form action="nuova_agenzia.php" method="post">
      <div>
        <label for="nome">Meta:</label>
        <input type="text" id="nome" name="nome">
      </div>
      <div>
        <label for="indirizzo">Data partenza:</label>
        <input type="date" id="indirizzo" name="indirizzo">
      </div>
      <div>
        <label for="telefono">Numero giorni:</label>
        <input type="number" id="telefono" name="telefono">
      </div>
      <div>
        <label for="organizzatore">Data partenza:</label>
        <input type="date" id="organizzatore" name="organizzatore">
      </div>
      <div>
        <label for="telefonoO">Numero giorni:</label>
        <input type="number" id="telefonoO" name="telefonoO">
      </div>
      <div>
        <label for="certificazioneiso">Data partenza:</label>
        <input type="date" id="certificazioneiso" name="certificazioneiso">
      </div>
      <div>
        <label for="assicurazione">Numero giorni:</label>
        <input type="number" id="assicurazione" name="assicurazione">
      </div>
      <input type="submit" value="Invia" id="invia">
    </form>
</body>
</html>
