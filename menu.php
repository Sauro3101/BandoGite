<?php
      session_start();
      if (!isset($_SESSION['admin'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
        header('Location: login.php');
        exit;
      }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Gestione progetti e utenti</title>
  <link rel="stylesheet" href="Stylesheets/gestione_progetti.css">
  <link rel="stylesheet" href="Stylesheets/menu.css">
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
  <nav>
    <div class="search-container">
      <form action="" method="POST">
        <?php
          $tit = "";
          if(isset($_POST['search'])){
            $tit = $_POST['search'];
          }
          echo "<input type='text' placeholder='Cerca titolo...' name='search' id='search' value='".$tit."'>";
        ?>
        <button type="submit">Cerca</button>
      </form>
    </div>
  </nav>
  <div class="container-menu">
    <h1>Ciao <?php echo $_SESSION['username']; ?>, benvenuto nell'area di amministrazione!</h1>
    <a href="gestione_offerte.php" class="btn">Gestione offerte</a>
    <a href="gestione_viaggi.php" class="btn">Gestione viaggi</a>
    <a href="gestione_agenzie.php" class="btn">Gestione agenzie</a>
  </div>
  <div class="container">
      <table>
      <tr>
        <th class="td_id">ID Offerta</th>
        <th class="td_titolo">Meta</th>
        <th class="td_anno">Data inizio</th>
        <th class="td_classi">Giorni</th>
        <th class="td_classi">Prezzo</th>
        <th class="td_utente">Utente</th>
      </tr>
      <?php
      // Connessione al database
      require 'backend/dbconfig.php';

      $conn = mysqli_connect($host, $user, $pass, $dbname);

      if(isset($_POST['search'])){
        $tit = $_POST['search'];
        unset($_POST['search']);
        
        // Query per selezionare il progetto cercato
        $sql = "SELECT offerta.ID AS idd, offerta.prezzo, offerta.IDUtente, viaggio.Meta, viaggio.partenza, viaggio.giorni FROM `offerta` INNER JOIN viaggio ON viaggio.ID = offerta.IDViaggio WHERE viaggio.meta LIKE '%$tit%' ORDER BY offerta.Punti DESC";
        
      }else{
        // Query per selezionare tutti i progetti
        $sql = "SELECT offerta.ID AS idd, offerta.prezzo, offerta.IDUtente, viaggio.Meta, viaggio.partenza, viaggio.giorni FROM offerta INNER JOIN viaggio ON viaggio.ID = offerta.IDViaggio ORDER BY offerta.Punti DESC";
      }

      $result = mysqli_query($conn, $sql);

      // Creazione della tabella
      while ($row = mysqli_fetch_array($result)) {
      ?>
        <tr>
      <td class="td_id"><?php echo $row['idd']; ?></td>
      <td class="td_titolo"><?php echo $row['Meta']; ?></td>
      <td class="td_anno"><?php echo $row['partenza']; ?></td>
      <td class="td_classi"><?php echo $row['giorni']; ?></td>
      <td class="td_classi"><?php echo $row['prezzo']; ?></td>
      <td class="td_utente"><?php echo $row['IDUtente']; ?></td>
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
