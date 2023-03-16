<?php
      session_start();
      if (!isset($_SESSION['email'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
        header('Location: login.php');
        exit;
      }
// Connessione al database
require 'backend/dbconfig.php';

$conn = new mysqli($host, $user, $pass, $dbname);

// Verifica la connessione
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ottieni l'id del progetto dalla richiesta POST
$id_progetto = $_POST['id_progetto'];

// Cartella in cui salvare le immagini
$target_dir = "uploads/";

// Cicla attraverso gli array di file ricevuti in POST
foreach($_FILES['immagini']['tmp_name'] as $key=>$tmp_name){
    // Ottieni il nome del file e il percorso temporaneo
    $file_name = $_FILES['immagini']['name'][$key];
    $file_tmp = $_FILES['immagini']['tmp_name'][$key];
    
    // Genera un nome univoco per il file
    $new_file_name = uniqid() . '_' . $file_name;
    
    // Crea il percorso completo in cui salvare il file
    $target_file = $target_dir . $new_file_name;
    
    // Muovi il file dalla cartella temporanea alla cartella di destinazione
    move_uploaded_file($file_tmp, $target_file);
    
    // Salva il percorso del file nel database
    $sql = "INSERT INTO immagini (id_progetto, path) VALUES ('$id_progetto', '$target_file')";
    $conn->query($sql);
}

// Chiudi la connessione al database
$conn->close();

// Redirect alla pagina di successo
header("Location: success.php");
?>
