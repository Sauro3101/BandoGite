<?php
      session_start();
      if (!isset($_SESSION['admin'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
        header('Location: login.php');
        exit;
      }
?>
<html>
<head>
  <link rel="stylesheet" href="Stylesheets/gestione_progetti.css">
  <link rel="icon" href="Immagini/fav-icon.png" type="image/png">
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
  <div class="header">
    <h1>Gestione Viaggi</h1>
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
    <div class="add-project">
      <a href="inseirsci_viaggio.php">Inserisci viaggio</a>
    </div>
  </nav>
  <div class="container">
    <table>
      <tr>
        <th class="td_id">ID</th>
        <th class="td_titolo">Meta</th>
        <th class="td_anno">Data partenza</th>
        <th class="td_classi">Giorni</th>
        <th class="td_azione">Azione</th>
      </tr>
      <?php
      // Connessione al database
      require 'backend/dbconfig.php';

      $conn = mysqli_connect($host, $user, $pass, $dbname);

      if(isset($_POST['search'])){
        $tit = $_POST['search'];
        unset($_POST['search']);
        
        // Query per selezionare il progetto cercato
        $sql = "SELECT * FROM `viaggio` WHERE meta LIKE '%$tit%'";
        
      }else{
        // Query per selezionare tutti i progetti
        $sql = "SELECT * FROM `viaggio`";
      }

      $result = mysqli_query($conn, $sql);

      // Creazione della tabella
      while ($row = mysqli_fetch_array($result)) {
      ?>
        <tr>
      <td class="td_id"><?php echo $row['ID']; ?></td>
      <td class="td_titolo"><?php echo $row['Meta']; ?></td>
      <td class="td_anno"><?php echo $row['Partenza']; ?></td>
      <td class="td_classi"><?php echo $row['Giorni']; ?></td>
      <td class="gestione td_azione">
        <div class="form-container-td">
          <!-- Elimina pulsante -->
          <form action="elimina_viaggio.php" method="post">
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