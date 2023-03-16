<?php
// Start the session
      session_start();
      if (!isset($_SESSION['email'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
        header('Location: login.php');
        exit;
      }
?>
<html>
<head>
  <link rel="stylesheet" href="Stylesheets/InserisciProg.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
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
    $query = "SELECT * FROM progetto WHERE IDProgetto = '$IDProgetto'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    } else {
    $row = $_SESSION["res"];
    }
    
    $query2 = "SELECT * FROM riferimento WHERE IDProgetto='$IDProgetto'";
    $execute2 = mysqli_query($conn, $query2);

  ?>
  <div class="form-container">
		<h1>Modifica Progetto</h1>
    <form action="backend/updateProg.php" method="POST">
      
      <label for="IDProgetto">ID Progetto:</label>
      <input type="text" name="IDProgetto" id="IDProgetto" required value="<?php echo $row["IDProgetto"] ?>"><br>
    
      <label for="TitoloProg">Titolo del Progetto:</label>
      <input type="text" name="TitoloProg" id="TitoloProg" required value="<?php echo $row["TitoloProg"] ?>"><br>
    
      <label for="DescProg">Descrizione del Progetto:</label>
      <textarea name="DescProg" id="DescProg" required><?php echo $row["DescProg"] ?></textarea><br>
			<script>
          CKEDITOR.replace( 'DescProg' );
      </script>

      <label for="AnnoInizio">Anno di inizio:</label>
      <input type="text" name="AnnoInizio" id="AnnoInizio" required value="<?php echo $row["AnnoInizio"] ?>"><br>
    
      <label for="AnnoFine">Anno di fine:</label>
      <input type="text" name="AnnoFine" id="AnnoFine" value="<?php echo $row["AnnoFine"] ?>"><br>
    
      <label for="PercorsoMedia">Percorso dei media:</label>
      <input type="text" name="PercorsoMedia" id="PercorsoMedia" value="<?php echo $row["PercorsoMedia"] ?>"><br>
    
      <label for="DocentiReferenti">Docenti referenti:</label>
      <input type="text" name="DocentiReferenti" id="DocentiReferenti" required value="<?php echo $row["DocentiReferenti"] ?>"><br>
    
      <label for="classi">Classe:</label>
      <input type="text" name="classi" id="classi" required value="<?php echo $row["classi"] ?>"><br>

      <?php
      if(isset($_SESSION['admin'])){
      ?>
      <label for="IDUtente">ID Utente:</label>
      <input type="text" name="IDUtente" id="IDUtente" required value="<?php echo $row["IDUtente"] ?>"><br>
      <?php
      }
      ?>
    
      <div id="sezioni">
      

      <?php
        if(mysqli_num_rows($execute2)>0) {
          for ($i=0; $i < mysqli_num_rows($execute2); $i++) { 
              //$ref = [];
              $riga=mysqli_fetch_array($execute2, MYSQLI_ASSOC);
              //print_r($riga);
    
              echo('
              <div class="sezione">
                <label for="titolo-sezione">Titolo sezione:</label>
                <input type="text" id="titolo-sezione" name="titolo-sezione'.$i.'" value="'.$riga["Titolo"].'">

                <label for="contenuto-sezione">Contenuto sezione:</label>
                <textarea id="contenuto-sezione" name="contenuto-sezione'.$i.'" rows="4" cols="50" >'.$riga["Descrizione"].'</textarea>

                <button class="rimuovi-sezione" type="button">Rimuovi sezione</button>
              </div>
              
              ');
              
          }
        }
        /*  
        <div class="sezione">
						<label for="titolo-sezione">Titolo sezione:</label>
						<input type="text" id="titolo-sezione" name="titolo-sezione`+index+`">

						<label for="contenuto-sezione">Contenuto sezione:</label>
						<textarea id="contenuto-sezione" name="contenuto-sezione`+index+`" rows="4" cols="50"></textarea>

						<button class="rimuovi-sezione" type="button">Rimuovi sezione</button>
					</div>
				`);


        */
      
      ?>
      </div>
      <button id="aggiungi-sezione" type="button">Aggiungi sezione</button>

      <input type="submit" value="Aggiorna">
    </form>
  </div>
</body>

<script>
		
		$(document).ready(function() {
      index = document.getElementsByClassName('sezione').length;
      //console.log(index)
			$("#aggiungi-sezione").click(function() {
				$("#sezioni").append(`
					<div class="sezione">
						<label for="titolo-sezione">Titolo sezione:</label>
						<input type="text" id="titolo-sezione" name="titolo-sezione`+index+`">

						<label for="contenuto-sezione">Contenuto sezione:</label>
						<textarea id="contenuto-sezione" name="contenuto-sezione`+index+`" rows="4" cols="50"></textarea>

						<button class="rimuovi-sezione" type="button">Rimuovi sezione</button>
					</div>
				`);
				index++;
			});

			$(document).on("click", ".rimuovi-sezione", function() {
				index--;
				$(this).parent().remove();
			});
		});
	</script>
</html>
