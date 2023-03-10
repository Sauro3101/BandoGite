<?php
    //error_reporting(E_ERROR | E_PARSE);
    session_start();

    if (isset($_SESSION["logged_in"])) { // se l'utente è già loggato viene automaticamente rimandato alla pagina.
        header('Location: page_new-offer.php');
        exit;
    }
    
    if (isset($_POST['password'])) {
      $username = $_POST["username"];
      $password = $_POST["password"];
    
      // Verifica se le credenziali corrispondono a un docente registrato nel database
    
      require 'db_config.php';
    
      $conn = new mysqli($host, $user, $pass, $db_name);
    
      if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
      }
    
      $sql = "SELECT * FROM user WHERE Username='$username'";
    
      $res = $conn->query($sql);
    
      if ($res->num_rows > 0){
        $row = $res->fetch_assoc();
        if (/* credenziali valide */$row["Password"] == $password) {
          // Inizia una sessione e imposta una variabile di sessione per indicare che l'utente ha effettuato l'accesso
          session_start();
          $_SESSION["logged_in"] = true;
      
          // Redirect all'area riservata
          header("Location: page_new-offer.php");
          exit;
        } else {
          // Mostra un messaggio di errore
          echo "Username o password non validi.";
        }
      }else{
        echo "Username non trovato";
      }
    }    
    
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="login.css">
  <title>Login</title>
</head>
<body>

  <h1>Login</h1>
  <form action="" method="post">
    <div>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username">
    </div>
    <div>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password">
    </div>
    <input type="submit" value="Accedi">
  </form>
  <p>Utente non registratto?</p>
  <a href="register.html">Registrati!</a>

</body>
</html>