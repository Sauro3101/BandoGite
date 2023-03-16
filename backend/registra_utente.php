<?php
// Start the session
      session_start();
      if (!isset($_SESSION['email'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
        header('Location: ../login.php');
        exit;
      }
      
      //Recupero i dati dal form
      $nome = $_POST['nome'];
      $cognome = $_POST['cognome'];
      $email = $_POST['email'];
      
      $oggetto = "Richiesta di registrazione ".$cognome;
      
      //Indirizzo email a cui inviare la mail
      $indirizzo_email = "museoScuolaVirtuale@gmail.com";
      
      //Compongo il corpo del messaggio
      $corpo = "Richiesta di rgistrazione dell'utente:\n\n";
      $corpo .= "Nome: " . $nome . "\n\n";
      $corpo .= "Cognome: " . $cognome . "\n\n";
      $corpo .= "Email: " . $email . "\n\n";
      
      //Invio la mail
      if(mail($indirizzo_email, $oggetto, $corpo)){
          echo "Messaggio inviato con successo.";
          header("Location: conferma.php");
      }else{
          echo "Si è verificato un errore durante l'invio del messaggio.";
      }
      
?>