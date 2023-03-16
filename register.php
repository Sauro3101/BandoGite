<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Verifica se le credenziali corrispondono a un docente registrato nel database

  require 'db_config.php';

  $conn = new mysqli($host, $user, $pass, $db_name);

  if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
  }

  $sql = "INSERT INTO user (Username, Password) VALUES ($username, $password)";

  $res = $conn->query($sql);

  if ($result->num_rows > 0){
    $row = $result->fetch_assoc();
    if (/* credenziali valide */$row["password"] == $password) {
      // Inizia una sessione e imposta una variabile di sessione per indicare che l'utente ha effettuato l'accesso
      $_SESSION["username"] = $username;
  
      // Redirect all'area riservata
      header("Location: offers.php");
      exit;
    } else {
      // Mostra un messaggio di errore
      echo "Username o password non validi.";
    }
  }else{
    echo "Username non trovato";
  }


  // ...

  
}
?>
