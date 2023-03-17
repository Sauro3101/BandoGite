<?php

session_start();
  require 'db_config.php';
  
  $conn = new mysqli($host, $user, $pass, $db_name);
  
  if ($conn->connect_error) {
      die("Connessione fallita: " . $conn->connect_error);
  }
  
  // Verifica che il form sia stato inviato
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati inviati dal form
    $viaggio_id = $_POST["viaggio"];
    $agenzia_id = $_POST["agenzia"];
    $utente_id = $_SESSION["idutente"];
    $prezzo = $_POST["prezzo"];
    $prezzo_point = $_POST["prezzo-point"];
    $stelle = $_POST["stelle"];
    $stelle_point = $_POST["stelle-point"];
    $alunni = $_POST["alunni"];
    $alunni_point = $_POST["alunni-point"];
    $zona = $_POST["zona"];
    $zona_point = $_POST["zona-point"];
    $mezzi = $_POST["mezzi"];
    $mezzi_point = $_POST["mezzi-point"];
    $ristorazione = $_POST["ristorazione"];
    $servizio = $_POST["servizio"];
    $treno = $_POST["treno"];
    $bus = $_POST["bus"];
    $esperienza = $_POST["esperienza"];
    $ristorazione_point = $_POST["ristorazione-point"];
    $servizio_point = $_POST["servizio-point"];
    $treno_point = $_POST["treno-point"];
    $bus_point = $_POST["bus-point"];
    $esperienza_point = $_POST["esperienza-point"];

    // Inserisci i dati nella tabella "offerta"
    $offerta_sql = "INSERT INTO offerta (IDViaggio, IDAgenzia, IDUtente, Prezzo, Stelle, Alunni, Zona, Mezzi, Ristorazione, Servizio, Treno, Bus, Esperienza) 
    VALUES ('$viaggio_id', '$agenzia_id', '$utente_id', '$prezzo', '$stelle', '$alunni', '$zona', '$mezzi', '$ristorazione', '$servizio', '$treno', '$bus', '$esperienza')";
    if ($conn->query($offerta_sql) === TRUE) {
        $offerta_id = $conn->insert_id;
    } else {
        echo "Errore nell'inserimento della nuova offerta: " . $conn->error;
    }

    // Inserisci i dati nella tabella "punti"
    $punti_sql = "INSERT INTO punti (offerta_id, prezzo_point, stelle_point, alunni_point, zona_point, mezzi_point, ristorazione_point, servizio_point, treno_point, bus_point, esperienza_point)
                        VALUES ('$offerta_id', '$prezzo_point', '$stelle_point', '$alunni_point', '$zona_point', '$mezzi_point', '$ristorazione_point', '$servizio_point', '$treno_point', '$bus_point', '$esperienza_point')";
    
    if ($conn->query($punti_sql) === TRUE) {
      echo "Dati inseriti con successo";
      header('Location: login.php');
    } else {
      echo "Errore nell'inserimento dei dati nella tabella punti: " . $conn->error;
    }
  }


  // Chiusura della connessione
  $conn->close();
?>
