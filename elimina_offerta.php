<?php
// Connessione al database
require 'db_config.php';

$conn = mysqli_connect($host, $user, $pass, $db_name);
if (!$conn) {
    die("Connessione al database fallita: " . mysqli_connect_error());
}

// Recupero il valore del campo "titolo" dalla richiesta POST
$IDProgetto = $_POST['id'];

// Costruzione della query SQL per eliminare il progetto
$sql = "DELETE FROM offerta WHERE ID='$IDProgetto'";

// Esecuzione della query
if (mysqli_query($conn, $sql)) {
    header('Location: gestione_offerte.php');
} else {
    echo "Errore nell'eliminazione del progetto: " . mysqli_error($conn);
  echo '<form action="gestione_offerte.php">';
  echo '<input type="submit" value="Torna alla pagina di gestione delle offerte">';
  echo '</form>';
}

// Chiusura della connessione al database
mysqli_close($conn);

?>