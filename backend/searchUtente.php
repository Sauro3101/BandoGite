<?php
// Start the session
      session_start();
      if (!isset($_SESSION['email'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
        header('Location: ../login.php');
        exit;
      }

$_SESSION['ricercaUtente'] = $_POST['search'];

// This is in the PHP file and sends a Javascript alert to the client
//$message = "Record updated successfully: ".$_SESSION['ricercaProgetto'];
//echo "<script type='text/javascript'>alert('$message');</script>";

header('Location: ../gestione_utenti.php');

?>