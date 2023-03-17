<?php
// Start the session
      session_start();
      if (!isset($_SESSION['username'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
        header('Location: login.php');
        exit;
      }
?>
<html>
<head>
  <link rel="stylesheet" href="Stylesheets/InserisciProg.css">
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
  <?php
    // Connessione al database
    require 'backend/dbconfig.php';

    $conn = mysqli_connect($host, $user, $pass, $dbname);
    
    if(isset($_POST['id'])) {
    // Get the project id
    $IDProgetto = $_POST['id'];
    
    // Get the project details from the database
    $query = "SELECT * FROM utente WHERE IDUtente = '$IDProgetto'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    } else {
    $row = $_SESSION["res"];
    }

  ?>
  <div class="form-container">
		<h1>Modifica Utente</h1>
    <form action="backend/updateUser.php" method="POST">

      <label for="IDUtente">ID Utente:</label>
      <input type="text" name="IDUtente" id="IDUtente" required value="<?php echo $row["IDUtente"] ?>"><br>

      <label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" required value="<?php echo $row["Nome"] ?>">

      <label for="cognome">Cognome:</label>
      <input type="text" id="cognome" name="cognome" required value="<?php echo $row["Cognome"] ?>">

			<label for="Email">Email:</label>
			<input type="mail" id="Email" name="Email" required value="<?php echo $row["Email"] ?>">

			<label for="Password">Password:</label>
			<input type="text" id="Password" name="Password" required value="<?php echo $row["Password"] ?>">

      <input type="submit" value="Aggiorna">
    </form>
  </div>
</body>
</html>
