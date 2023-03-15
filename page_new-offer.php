<?php
      session_start();
      if(!$_SESSION["logged_in"]){
        header("Location: page_login.php");
      }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/offers.css">
    <title>Nuova proposta</title>
</head>
<body>
  <h1>Inserisci proposta</h1>
    <form action="new-offer.php" method="post" onchange="check()">
      <div>
      <?php
        require 'db_config.php';

        $conn = new mysqli($host, $user, $pass, $db_name);
      
        if ($conn->connect_error) {
          die("Connessione fallita: " . $conn->connect_error);
        }
      
        $sql = "SELECT * FROM lotto";
      
        $res = $conn->query($sql);
      
        if ($res->num_rows > 0){
      ?>
        <label for="lotto">Seleziona il viaggio per cui inserire la proposta:</label>
        <select name="lotto" id="lotto">
        <?php
          for ($x = 0; $x < $res->num_rows; $x++) {
            $row = $res->fetch_assoc();
            ?>
            <option value='<?php echo $x; ?>'><?php echo $row["Meta"]; ?></option>
            <?php
          }
        ?>
        </select>
      <?php
        }else{
          echo "Errore: Nessun lotto inserito!";
        }
      ?>
      </div>
      <div>
      <?php
        $sql = "SELECT * FROM agenzia";
      
        $res = $conn->query($sql);
      
        if ($res->num_rows > 0){
      ?>
        <label for="agenzia">Seleziona l'agenzia per cui inserire la proposta:</label>
        <select name="agenzia" id="agenzia">
        <?php
          for ($x = 0; $x < $res->num_rows; $x++) {
            $row = $res->fetch_assoc();
            ?>
            <option value='<?php echo $x; ?>'><?php echo $row["NomeAgenzia"]; ?></option>
            <?php
          }
        ?>
        </select>
      <?php
        }else{
          echo "Errore: Nessuna agenzia inserita!";
        }
      
      ?>
      </div>
      <div>
        <label for="price">Prezzo:</label>
        <input type="text" id="price" name="price">
        <input type="number" id="price-point" name="price-point" class="point" min="0" max="100">
      </div>
      <div>
        <label for="other">Altro:</label>
        <textarea id="other" name="other"></textarea>
        <input type="number" id="other-point" name="other-point" class="point" min="0" max="100">
      </div>
      <div>
        <label for="services">Servizi:</label>
        <textarea id="services" name="services"></textarea>
        <input type="number" id="serivces-point" name="serivces-point" class="point" min="0" max="100">
      </div>
      <input type="hidden" name="tot" id="tot" value="0" />
      <p id="error_100">Assicurarsi che il punteggio totale sia al massimo pari a 100!</p>
      <input type="submit" value="Invia" id="invia">
    </form>

    <script>
      function check(){

        var arr = document.querySelectorAll('.point');
        var tot = 0;
        for(var i = 0; i < arr.length; i++){
          if(parseInt(arr[i].value)){
            tot += parseInt(arr[i].value);
          }
        }
        var totale = document.getElementById('tot');
        totale.value = tot;
        var error_100 = document.getElementById('error_100');
        var btn = document.getElementById('invia');
        if(tot > 100){
          btn.disabled = true;
          error_100.style.display = "block";
        }else{
          btn.disabled = false;
          error_100.style.display = "none";
        }
        
      }
    </script>
      
</body>
</html>