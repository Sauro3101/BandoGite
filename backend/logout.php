<?php
      session_start();
      if (!isset($_SESSION['email'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
        header('Location: ../login.php');
        exit;
      }

// Distruzione della sessione
session_unset();
session_destroy();

// Reindirizzamento alla pagina di login
header("Location: ../login.php");
exit();
?>