<?php
// Connessione al database
require 'db_config.php';

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$meta = $_POST['meta'];
$partenza = $_POST['partenza'];
$giorni = $_POST['giorni'];

// Prepare and execute SQL query to insert new record
$sql = "INSERT INTO `viaggio`(`Meta`, `Partenza`, `Giorni`) VALUES ('$meta','$partenza','$giorni')";

$query1 = $conn->query($sql);

if ($query1 === TRUE) {

    // This is in the PHP file and sends a Javascript alert to the client
    //$message = "Progetto inserito con successo!";
    //echo "<script type='text/javascript'>alert('$message');</script>";
    //header('Location: gestione_progetti.php');
    

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header('Location: inserisci_viaggio.php');
?>