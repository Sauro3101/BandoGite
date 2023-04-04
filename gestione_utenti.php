<?php
      session_start();
      if (!isset($_SESSION['admin'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
        header('Location: login.php');
        exit;
      }
?>
<html>
<head>
  <title>Gestione Utenti</title>
  <link rel="stylesheet" href="Stylesheets/gestione_utenti.css">
  <link rel="icon" href="Immagini/fav-icon.png" type="image/png">
</head>
<body>
  <div class="navbar">
  <div class="menu">
    <a href="menu.php">Menu</a>
    <a href="gestione_offerte.php">Gestione offerte</a>
    <a href="gestione_viaggi.php">Gestione viaggi</a>
    <a href="gestione_agenzie.php">Gestione agenzie</a>
      <a href="classifica.php">Visualizza classifica</a>
  </div>
    <div class="logout">
      <a href="backend/logout.php">Logout</a>
    </div>
  </div>
  <div class="header">
    <h1>Gestione Utenti</h1>
  </div>
    <nav>
      <div class="search-container">
        <form action="" method="POST"><?php
            $ric = "";
            if(isset($_POST['search-u'])){
              $ric = $_POST['search-u'];
            }
            echo "<input type='text' placeholder='Cerca...' name='search-u' id='search' value='".$ric."'>";

          ?>
          <button type="submit">Cerca</button>
        </form>
      </div>
      <div class="add-user">
        <a href="inserisciUtente.php">Inserisci Utente</a>
      </div>
    </nav>
  <div class="container">
      <table>
      <tr>
        <th>ID Utente</th>
        <th>Username</th>
        <th>Password</th>
        <th>Azione</th>
      </tr>
      <?php
      // Connessione al database
      require 'backend/dbconfig.php';

      $conn = mysqli_connect($host, $user, $pass, $dbname);


      if(isset($_POST['search-u'])){
        $ric = $_POST['search-u'];
        unset($_POST['search-u']);
        
        // Query per selezionare il progetto cercato
        $sql = "SELECT * FROM utente WHERE Nome LIKE '%$ric%' OR Cognome LIKE '%$ric%' OR Email LIKE '%$ric%'";
        
      }else{
        // Query per selezionare tutti i progetti
        $sql = "SELECT * FROM utente";
      }

      $result = mysqli_query($conn, $sql);

      // Creazione della tabella
      while ($row = mysqli_fetch_array($result)) {
      ?>
        <tr>
      <td><?php echo $row['ID']; ?></td>
      <td><?php echo $row['Username']; ?></td>
      <td><?php echo $row['Password']; ?></td>
      <td class="gestione">
        <div class="form-container-td">
          <!-- Modifica pulsante -->
          <form action="modificaUtente.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
            <input type="submit" value="Modifica" class="edit-btn">
          </form>
        </div>
        <div class="form-container-td">
          <!-- Elimina pulsante -->
          <form action="elimina_utente.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
            <input type="submit" value="Elimina" class="delete-btn" onclick="return confirm('Sei sicuro di voler eliminare questo progetto?');">
          </form>
        </div>
      </td>
    </tr>
    <?php
      }

      // Chiusura della connessione
      mysqli_close($conn);
      ?>
    </table>
  </div>
</body>
</html>