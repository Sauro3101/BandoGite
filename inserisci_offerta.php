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
  <?php 
  if(isset($_SESSION['admin'])){
  ?>
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
  <?php
  } else {
  ?>
  <div class="navbar">
    <div class="menu">
      <a href="gestione_offerte.php">Gestione offerte</a>
    </div>
    <div class="logout">
      <a href="backend/logout.php">Logout</a>
    </div>
  </div>
  <?php }?>
	<div class="form-container">
		<h1>Nuova offerta</h1>
		<form action="nuova_offerta.php" method="post" onchange="check()">
      <div>
      <?php
        require 'db_config.php';

        $conn = new mysqli($host, $user, $pass, $db_name);
      
        if ($conn->connect_error) {
          die("Connessione fallita: " . $conn->connect_error);
        }
      
        $sql = "SELECT * FROM viaggio";
      
        $res = $conn->query($sql);
      
        if ($res->num_rows > 0){
      ?>
        <label for="viaggio">Seleziona il viaggio per cui inserire la proposta:</label>
        <select name="viaggio" id="viaggio">
        <?php
          for ($x = 0; $x < $res->num_rows; $x++) {
            $row = $res->fetch_assoc();
            ?>
            <option value='<?php echo $x; ?>'><?php echo $row["Meta"]; ?></option>
            <?php
          }
        ?>
        </select>
      <?php
        }else{
          echo "Errore: Nessun viaggio inserito!";
        }
      ?>
      </div>
      <div>
      <?php
        $sql = "SELECT * FROM agenzia";
      
        $res = $conn->query($sql);
      
        if ($res->num_rows > 0){
      ?>
        <label for="agenzia">Seleziona l'agenzia per cui inserire la proposta:</label>
        <select name="agenzia" id="agenzia">
        <?php
          for ($x = 0; $x < $res->num_rows; $x++) {
            $row = $res->fetch_assoc();
            ?>
            <option value='<?php echo $row["ID"]; ?>'><?php echo $row["Nome"]; ?></option>
            <?php
          }
        ?>
        </select>
      <?php
        }else{
          echo "Errore: Nessuna agenzia inserita!";
        }
      
      ?>
      </div>
      <hr>
      <div>
        <label for="prezzo">Prezzo:</label>
        <input type="text" id="prezzo" name="prezzo">
        <div class="point_section">
          <label for="prezzo-point">Punti:</label>
          <input type="number" id="prezzo-point" name="prezzo-point" class="point" min="0" max="100">
        </div>
      </div>
      <hr>
      <div>
        <label for="stelle">Stelle:</label>
        <select name="stelle" id="stelle">
          <option value="4">4</option>
          <option value="3 sup.">3 sup.</option>
          <option value="3">3</option>
          <option value="Inferiore">Inferiore</option>
        </select>
        <div class="point_section">
          <label for="stelle-point">Punti:</label>
          <input type="number" id="stelle-point" name="stelle-point" class="point" min="0" max="100">
        </div>
      </div>
      <hr>
      <div>
        <label for="alunni">Alunni per camera:</label>
        <input type="number" id="alunni" name="alunni">
        <div class="point_section">
          <label for="alunni-point">Punti:</label>
          <input type="number" id="alunni-point" name="alunni-point" class="point" min="0" max="100">
        </div>
      </div>
      <hr>
      <div>
        <label for="zona">Zona:</label>
        <select name="zona" id="zona">
          <option value="Centrale">Centrale</option>
          <option value="Semicentrale">Semicentrale</option>
          <option value="Limitrofa">Limitrofa</option>
          <option value="Periferica">Periferica</option>
        </select>
        <div class="point_section">
          <label for="zona-point">Punti:</label>
          <input type="number" id="zona-point" name="zona-point" class="point" min="0" max="100">
        </div>
      </div>
      <hr>
      <div>
        <label for="mezzi">Mezzi:</label>
        <div class="point_section">
          <input type="radio" id="mezzi-si" name="mezzi" value="si">
          <label for="mezzi-si">Si</label>
          <input type="radio" id="mezzi-no" name="mezzi" value="no">
          <label for="mezzi-no">No</label>
        </div>
        <br>
        <div class="point_section">
          <label for="mezzi-point">Punti:</label>
          <input type="number" id="mezzi-point" name="mezzi-point" class="point" min="0" max="100">
        </div>
      </div>
      <hr>
      <div>
        <label for="ristorazione">Ristorazione:</label>
        <select name="ristorazione" id="ristorazione">
          <option value="Hotel">Hotel</option>
          <option value="Ristorante">Ristorante</option>
          <option value="Altro ristorante">Altro ristorante</option>
        </select>
        <div class="point_section">
          <label for="ristorazione-point">Punti:</label>
          <input type="number" id="ristorazione-point" name="ristorazione-point" class="point" min="0" max="100">
        </div>
      </div>
      <hr>
      <div>
        <label for="servizio">Servizio:</label>
        <select name="servizio" id="servizio">
          <option value="Servito">Servito</option>
          <option value="Buffet">Buffet</option>
        </select>
        <div class="point_section">
          <label for="servizio-point">Punti:</label>
          <input type="number" id="servizio-point" name="servizio-point" class="point" min="0" max="100">
        </div>
      </div>
      <hr>
      <div>
        <label for="treno">Treno:</label>
        <select name="treno" id="treno">
          <option value="No">No</option>
          <option value="Alta velocità">Alta velocità</option>
          <option value="Intercity">Intercity</option>
          <option value="Cuccette 4">Cuccette 4</option>
          <option value="Cuccette 6">Cuccette 6</option>
        </select>
        <div class="point_section">
          <label for="treno-point">Punti:</label>
          <input type="number" id="treno-point" name="treno-point" class="point" min="0" max="100">
        </div>
      </div>
      <hr>
      <div>
        <label for="bus">Bus:</label>
        <select name="bus" id="bus">
          <option value="1">No</option>
          <option value="2">1 Autista</option>
          <option value="3">2 Autisti</option>
          <option value="4">Viaggio A/R</option>
        </select>
        <div class="point_section">
          <label for="bus-point">Punti:</label>
          <input type="number" id="bus-point" name="bus-point" class="point" min="0" max="100">
        </div>
      </div>
      <hr>
      <div>
        <label for="esperienza">Esperienza:</label>
        <select name="esperienza" id="esperienza">
          <option value="1">> 5 anni</option>
          <option value="2">tra 4 e 5 anni</option>
          <option value="3">< 4 anni</option>
        </select>
        <div class="point_section">
          <label for="esperienza-point">Punti:</label>
          <input type="number" id="esperienza-point" name="esperienza-point" class="point" min="0" max="100">
        </div>
      </div>
      <hr>
      <input type="hidden" name="tot" id="tot" value="0" />
        <p id="error_100">Assicurarsi che il punteggio totale sia al massimo pari a 100!</p>
        <input type="submit" value="Invia" id="invia">
    </form>
	</div>
</body>
</html>