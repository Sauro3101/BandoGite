<?php
// Connessione al database
require 'dbconfig.php';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$nome = $_POST['nome'];
$indirizzo = $_POST['indirizzo'];
$telefono = $_POST['telefono'];
$organizzatore = $_POST['organizzatore'];
$telefonoO = $_POST['telefonoO'];
$certificazioneiso = $_POST['certificazioneiso'];
$assicurazione = $_POST['assicurazione'];

// Prepare and execute SQL query to insert new record
$sql = "INSERT INTO `agenzia`(`Nome`, `Indirizzo`, `Telefono`, `Organizzatore`, `TelefonoOrganizzatore`, `CertificazioneISO`, `Assicurazione`)
         VALUES ('$nome','$indirizzo','$telefono','$organizzatore','$telefonoO','$certificazioneiso','$assicurazione')";

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
header('Location: ../gestione_agenzie.php');
?>