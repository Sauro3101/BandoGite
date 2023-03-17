<?php
// Connessione al database
require 'dbconfig.php';

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connessione al database fallita: " . mysqli_connect_error());
}

// Recupero il valore del campo "titolo" dalla richiesta POST
$IDProgetto = $_POST['id'];

// Costruzione della query SQL per eliminare il progetto
$sql = "DELETE FROM viaggio WHERE ID='$IDProgetto'";

// Esecuzione della query
if (mysqli_query($conn, $sql)) {
    header('Location: ../gestione_viaggi.php');
} else {
    echo "Errore nell'eliminazione del progetto: " . mysqli_error($conn);
  echo '<form action="../gestione_viaggi.php">';
  echo '<input type="submit" value="Torna alla pagina di gestione dei viaggi">';
  echo '</form>';
}

// Chiusura della connessione al database
mysqli_close($conn);

?>