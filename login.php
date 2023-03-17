<?php
    //error_reporting(E_ERROR | E_PARSE);
    session_start();

    if (isset($_SESSION['username'])) { // se l'utente è già loggato viene automaticamente rimandato alla pagina.
        header('Location: menu.php');
        exit;
    }
    if(isset($_POST["password"])){

        $passwd= $_POST['password'];
        $username=$_POST['username'];
        
        //echo '<h1>'.$passwd.'</>';

        require 'backend/dbconfig.php';

        $conn = mysqli_connect($host, $user, $pass, $dbname);

        //print_r($conn);
        if ($conn->connect_error) {
            echo 'error';
            die("Connection failed: " . $conn->connect_error);
        }

        $query= "SELECT * FROM utente WHERE username='$username' AND password='$passwd'";
        //echo $query;
        $execute = mysqli_query($conn,$query);
        //print_r($execute);
        
        if(mysqli_num_rows($execute)>0) {
            $riga=mysqli_fetch_array($execute, MYSQLI_ASSOC);

            $_SESSION['username'] = $username;
            $_SESSION['password'] = $passwd;
            $_SESSION['idutente'] = $riga["ID"];
            if($riga["Amministrazione"]){
                $_SESSION['admin'] = 1;
                header('Location: menu.php');
            } else {
                header('Location: gestione_offerte.php');
            }
            
        }else{
            echo "Login non valido.";
        }
        mysqli_close($conn);


    }

    
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Login | Museo IIS Falcone Righi</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Immagini/fav-icon.png" type="image/png">
    <link rel="stylesheet" href="Stylesheets/style.css">
    <link rel="stylesheet" href="Stylesheets/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <form method="post" action="">
        <h2>LOGIN</h2>
        <div>
            <p>Username</p>
            <input type="text" name="username">
        </div>
        <div>
            <p>Password</p>
            <input type="password" name="password">
        </div>
        <input type="submit" value="Accedi">
        <a href="index.html">Torna alla home</a>
    </form>
</body>
</html>