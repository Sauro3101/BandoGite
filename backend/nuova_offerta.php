<?php

session_start();
  require 'dbconfig.php';
  
  $conn = new mysqli($host, $user, $pass, $dbname);
  
  if ($conn->connect_error) {
      die("Connessione fallita: " . $conn->connect_error);
  }



/*

$prezzo = $_POST["prezzo"];
		$prezzo_punteggio = 0;
		if ($prezzo < 50) {
			$prezzo_punteggio = 5;
		} elseif ($prezzo >= 50 && $prezzo <= 100) {
			$prezzo_punteggio = 3;
		} else {
			$prezzo_punteggio = 1;
		}

		$stelle = $_POST["stelle"];
		$stelle_punteggio = 0;
		if ($stelle == "4") {
			$stelle_punteggio = 5;
		} elseif ($stelle == "3 sup.") {
			$stelle_punteggio = 4;
		} elseif ($stelle == "3") {
			$stelle_punteggio = 3;
		} else {
			$stelle_punteggio = 1;
		}

		$alunni = $_POST["alunni"];
		$alunni_punteggio = 0;
		if ($alunni <= 2) {
			$alunni_punteggio = 5;
		} elseif ($alunni == 3) {
			$alunni_punteggio = 3;
		} else {
			$alunni_punteggio = 1;
		}

		$zona = $_POST["zona"];
		$zona_punteggio = 0;
		if ($zona == "Centrale") {
			$zona_punteggio = 5;
		} elseif ($zona == "Semicentrale") {
			$zona_punteggio = 4;
		} elseif ($zona == "Limitrofa") {
			$zona_punteggio = 3;
		} else {
			$zona_punteggio = 1;
		}

		$mezzi = $_POST["mezzi"];
		$mezzi_punteggio = 0;
		if ($mezzi == "si") {
			$mezzi_punteggio = 5;
		} else {
			$mezzi_punteggio = 1;
		}

		$ristorazione = $_POST["ristorazione"];
		$ristorazione_punteggio = 0;
		if ($ristorazione == "Hotel") {
			$ristorazione_punteggio = 5;
		} elseif ($ristorazione == "Ristorante") {
			$ristorazione_punteggio = 3;
		} else {
			$ristorazione_punteggio = 1;
		}

		$servizio = $_POST["servizio"];
		$servizio_punteggio = 0;
		if ($servizio == "Servito") {
			$servizio_punteggio

*/




  
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
    $totale = $_POST["tot"];

    // Inserisci i dati nella tabella "offerta"
    $offerta_sql = "INSERT INTO offerta (IDViaggio, IDAgenzia, IDUtente, Prezzo, Stelle, Alunni, Zona, Mezzi, Ristorazione, Servizio, Treno, Bus, Esperienza, Punti) 
    VALUES ('$viaggio_id', '$agenzia_id', '$utente_id', '$prezzo', '$stelle', '$alunni', '$zona', '$mezzi', '$ristorazione', '$servizio', '$treno', '$bus', '$esperienza', '$totale')";
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
      header('Location: ../gestione_offerte.php');
    } else {
      echo "Errore nell'inserimento dei dati nella tabella punti: " . $conn->error;
    }
  }


  // Chiusura della connessione
  $conn->close();
?>
