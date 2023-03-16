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
$titolo = $_POST['titolo'];
$descrizione = $_POST['descrizione'];
$inizio = $_POST['inizio'];
$fine = $_POST['fine'];
//$files = $_POST['files'];
$files = "Inserire percorso media";
$docenti = $_POST['docenti'];
$classe = $_POST['classe'];
$idUtente = $_SESSION['idutente'];

// Prepare and execute SQL query to insert new record
$sql = "INSERT INTO `progetto`(`TitoloProg`, `DescProg`, `AnnoInizio`, `AnnoFine`, `PercorsoMedia`, `DocentiReferenti`, `classi`, `IDUtente`) 
VALUES ('$titolo', '$descrizione', '$inizio', '$fine', '$files', '$docenti', '$classe', '$idUtente')";

$query1 = $conn->query($sql);

if ($query1 === TRUE) {

    // This is in the PHP file and sends a Javascript alert to the client
    //$message = "Progetto inserito con successo!";
    //echo "<script type='text/javascript'>alert('$message');</script>";
    //header('Location: gestione_progetti.php');
    

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}



$sql2 = ""; 
$select = "SELECT IDProgetto FROM progetto WHERE TitoloProg ='".$titolo."' AND DescProg = '".$descrizione."'";

$idprogetto = $conn->query($select)->fetch_assoc()["IDProgetto"];

for ($i=0; $i < (count($_POST)-6)/2; $i++) { 
  $sql2 = $sql2."INSERT INTO riferimento(`Titolo`, `Descrizione`, `IDProgetto`) VALUES ('".$_POST["titolo-sezione".strval($i)]."','".$_POST["contenuto-sezione".strval($i)]."','".$idprogetto."'); ";
}

//echo $sql2;

$query2 = $conn->multi_query($sql2);

if ($query2 === TRUE) {

    // This is in the PHP file and sends a Javascript alert to the client
    $message = "Progetto inserito con successo!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header('Location: ../gestione_progetti.php');
    

} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}


$conn->close();

?>

<?php
/*
if (isset($_POST['submit'])) {
  // Verifica che sia stato caricato un file
  if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    echo 'Errore: Nessun file selezionato';
    exit();
  }

  // Connetti al database
  require 'dbconfig.php';

  $conn = mysqli_connect($host, $user, $pass, $dbname);
  if (!$conn) {
    die('Connessione al database fallita: ' . mysqli_connect_error());
  }

  // Prepara l'istruzione SQL per l'inserimento del file nel database
  $stmt = $conn->prepare("INSERT INTO media (nome, tipo, dati) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $nome_file, $tipo_file, $dati_file);

  // Leggi il file dal buffer temporaneo e prepara i dati per l'inserimento nel database
  $nome_file = $_FILES['file']['name'];
  $tipo_file = $_FILES['file']['type'];
  $dati_file = file_get_contents($_FILES['file']['tmp_name']);

  // Esegui l'istruzione SQL
  if (!$stmt->execute()) {
    echo 'Errore nell\'inserimento del file nel database: ' . $stmt->error;
    exit();
  }

  // Chiudi la connessione al database
  mysqli_close($conn);

  // Mostra un messaggio di successo
  echo 'Il file è stato caricato correttamente nel database.';
}
*/
?>