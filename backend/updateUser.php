<?php
// Start the session
      session_start();
      if (!isset($_SESSION['email'])) { // se l'utente non è loggato viene automaticamente rimandato alla pagina di login.
        header('Location: ../login.php');
        exit;
      }
// Connessione al database
require 'dbconfig.php';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$IDUtente = $_POST['IDUtente'];
$Nome = $_POST['nome'];
$Cognome = $_POST['cognome'];
$Email = $_POST['Email'];
$Password = $_POST['Password'];

// Prepare and execute SQL query to insert new record
$sql = "UPDATE `utente` 
SET `IDUtente`='$IDUtente', `Nome`='$Nome', `Cognome`='$Cognome', `Email`='$Email', `Password`='$Password'
WHERE `IDUtente`='$IDUtente'";

if ($conn->query($sql) === TRUE) {

    // This is in the PHP file and sends a Javascript alert to the client
    $message = "Record updated successfully";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header('Location: ../gestione_utenti.php');

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>