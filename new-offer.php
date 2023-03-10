<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $agency = $_POST['agenzia'];
  $trip = $_POST['trip'];
  $price = $_POST['price'];
  $services = $_POST['services'];
  $tot = $_POST['tot'];

  //funziona, il totale arriva
  echo $tot;

  // Connessione al database
  require 'db_config.php';
  $conn = new mysqli($host, $user, $pass, $db_name);
  if ($conn->connect_error) {
    die('Errore di connessione: ' . $conn->connect_error);
  }

  // Preparazione della query
  $sql = "INSERT INTO offers (agency, trip, price, services)
          VALUES ('$agency', '$trip', '$price', '$services')";

  // Esecuzione della query
  if ($conn->query($sql) === TRUE) {
    echo "Offerta inserita con successo";
  } else {
    echo "Errore nell'inserimento dell'offerta: " . $conn->error;
  }

  // Chiusura della connessione
  $conn->close();
}
?>
