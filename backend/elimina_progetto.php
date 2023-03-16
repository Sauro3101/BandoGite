<?php
      session_start();
      if (!isset($_SESSION['email'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
        header('Location: ../login.php');
        exit;
      }

// Connessione al database
require 'dbconfig.php';

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connessione al database fallita: " . mysqli_connect_error());
}

// Recupero il valore del campo "titolo" dalla richiesta POST
$IDProgetto = $_POST['id'];

// Costruzione della query SQL per eliminare il progetto
$sql = "DELETE FROM progetto WHERE IDProgetto='$IDProgetto'";

// Esecuzione della query
if (mysqli_query($conn, $sql)) {
    echo "Progetto eliminato con successo.";
  echo '<form action="../gestione_progetti.php">';
  echo '<input type="submit" value="Torna alla pagina iniziale">';
  echo '</form>';
} else {
    echo "Errore nell'eliminazione del progetto: " . mysqli_error($conn);
  echo '<form action="../gestione_progetti.php">';
  echo '<input type="submit" value="Torna alla pagina iniziale">';
  echo '</form>';
}

// Chiusura della connessione al database
mysqli_close($conn);

?>
