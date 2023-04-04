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
  <div class="container-menu">
    <h1>Classifica delle offerte per viaggio</h1>
    <?php
    require 'backend/dbconfig.php';

    $conn = new mysqli($host, $user, $pass, $dbname);
    
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM viaggio";
    
    $res = $conn->query($sql);
    
    if ($res->num_rows > 0){
    ?>
    <form action="" method="post">
        <label for="viaggio">Seleziona il viaggio di cui vedere la classifica:</label>
        <select name="viaggio" id="viaggio">
            <option value='0' selected disabled>Seleziona meta</option>
            <?php
                for ($x = 0; $x < $res->num_rows; $x++) {
                $row = $res->fetch_assoc();
                ?>
                <option value='<?php echo $row["ID"]; ?>'><?php echo $row["Meta"]; ?></option>
                <?php
                }
            ?>
        </select>
        <input type="submit" value="Visualizza">
    </form>
    <?php
    }else{
        echo "Errore: Nessun viaggio inserito!";
    }
    ?>
    </div>
  </div>
  <div class="container">
        <?php
        // Connessione al database
        require 'backend/dbconfig.php';

        $conn = mysqli_connect($host, $user, $pass, $dbname);

        if(isset($_POST['viaggio'])){
            $tit = $_POST['viaggio'];
            unset($_POST['viaggio']);
            
            // Query per selezionare il progetto cercato
            $sql = "SELECT offerta.ID AS idd, offerta.prezzo, offerta.IDUtente, offerta.Punti, viaggio.Meta, viaggio.partenza, viaggio.giorni FROM `offerta` INNER JOIN viaggio ON viaggio.ID = offerta.IDViaggio WHERE viaggio.ID = '$tit' ORDER BY offerta.Punti DESC";
            

            $result = mysqli_query($conn, $sql);

            ?>
            <table>
                <tr>
                    <th class="td_id">ID Offerta</th>
                    <th class="td_meta">Meta</th>
                    <th class="td_partenza">Data inizio</th>
                    <th class="td_giorni">Giorni</th>
                    <th class="td_prezzo">Prezzo</th>
                    <th class="td_utente">Utente</th>
                    <th class="td_punti">Punteggio</th>
                </tr>
            <?php
            // Creazione della tabella
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td class="td_id"><?php echo $row['idd']; ?></td>
                    <td class="td_meta"><?php echo $row['Meta']; ?></td>
                    <td class="td_partenza"><?php echo $row['partenza']; ?></td>
                    <td class="td_giorni"><?php echo $row['giorni']; ?></td>
                    <td class="td_prezzo"><?php echo $row['prezzo']; ?>$</td>
                    <td class="td_utente"><?php echo $row['IDUtente']; ?></td>
                    <td class="td_punti"><?php echo $row['Punti']; ?></td>
                </tr>
            <?php
            }

            // Chiusura della connessione
            mysqli_close($conn);
        }
        ?>
    </table>
  </div>
</body>
</html>
