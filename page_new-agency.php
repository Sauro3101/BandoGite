<?php
      session_start();
      if(!isset($_SESSION["username"])){
        header("Location: page_login.php");
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/offers.css">
    <title>Nuova agenzia</title>
</head>
<body>
  <h1>Inserisci agenzia</h1>
    <form action="new-agency.php" method="post">
      <div>
        <label for="agency">Nome agenzia:</label>
        <input type="text" id="agency" name="agency">
        <input type="number" id="agency-point" name="agency-point">
      </div>
      <div>
        <label for="address">Indirizzo:</label>
        <input type="text" id="address" name="address">
        <input type="number" id="address-point" name="address-point">
      </div>
      <div>
        <label for="phone">Telefono:</label>
        <input type="text" id="phone" name="phone">
        <input type="number" id="phone-point" name="phone-point">
      </div>
      <div>
        <label for="manager">Organizzatore:</label>
        <input type="text" id="manager" name="manager">
        <input type="number" id="manager-point" name="manager-point">
      </div>
      <div>
        <label for="manager-phone">Telefono organizzatore:</label>
        <input type="text" id="manager-phone" name="manager-phone">
        <input type="number" id="manager-phone-point" name="manager-phone-point">
      </div>
      <div>
        <label for="iso">Certificazione ISO:</label>
        <input type="radio" id="yes" name="iso" value="true">
        <label for="yes">SI</label>
        <input type="radio" id="no" name="iso" value="false">
        <label for="no">NO</label>
        <input type="number" id="iso-point" name="iso-point">
      </div>
      <div>
        <label for="insurance">Assicurazione:</label>
        <input type="text" id="insurance" name="insurance">
        <input type="number" id="insurance-point" name="insurance-point">
      </div>
        <input type="number" id="serivces-point" name="serivces-point">
      </div>
      <input type="submit" value="Invia">
    </form>
      
</body>
</html>