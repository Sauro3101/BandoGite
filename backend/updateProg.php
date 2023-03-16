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
$id = $_POST['IDProgetto'];
$titolo = $_POST['TitoloProg'];
$descrizione = $_POST['DescProg'];
$inizio = $_POST['AnnoInizio'];
$fine = $_POST['AnnoFine'];
//$files = $_POST['PercorsoMedia'];
$files = "Inserire percorso media";
$docenti = $_POST['DocentiReferenti'];
$classe = $_POST['classi'];

// Prepare and execute SQL query to insert new record
$sql = "UPDATE `progetto` 
SET `TitoloProg`='$titolo', `DescProg`='$descrizione', `AnnoInizio`='$inizio', `AnnoFine`='$fine', 
`PercorsoMedia`='$files', `DocentiReferenti`='$docenti', `classi`='$classe'";
if(isset($_SESSION['admin'])){
    $IDUtente = $_POST['IDUtente'];
    $sql .= ", `IDUtente`='$IDUtente'"
}
" WHERE `IDProgetto`='$id'";

if ($conn->query($sql) === TRUE) {

    // This is in the PHP file and sends a Javascript alert to the client
    //$message = "Record updated successfully";
    //echo "<script type='text/javascript'>alert('$message');</script>";
    //header('Location: gestione_progetti.php');

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql2 = "DELETE FROM riferimento WHERE IDProgetto ='".$id."'";
$query2 = $conn->query($sql2);

if ($query2 !== TRUE) {
    echo "Error: " . $sql3 . "<br>" . $conn->error;
}


$sql3 = "";
$q3 = 0;

//print_R($_POST);



for ($i=0; $i < (count($_POST)-10)/2; $i++) {
    $q3++;
    $sql3 = $sql3."INSERT INTO riferimento(`Titolo`, `Descrizione`, `IDProgetto`) VALUES ('".$_POST["titolo-sezione".$i]."','".$_POST["contenuto-sezione".$i]."','".$id."'); \n";
    
}

//echo $sql3;

if($q3 > 0){
    $query3 = $conn->multi_query($sql3);
}

if(isset($query3)){
    if ($query3 === TRUE) {

        // This is in the PHP file and sends a Javascript alert to the client
        $message = "Progetto modificato con successo!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header('Location: ../gestione_progetti.php');
        

    } else {
        echo "Error: " . $sql3 . "<br>" . $conn->error;
    }
}else{
    // This is in the PHP file and sends a Javascript alert to the client
    $message = "Progetto modificato con successo!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header('Location: ../gestione_progetti.php');
}


$conn->close();


?>