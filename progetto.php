<?php

    if(isset($_GET["id"])){

        $id= $_GET["id"];
        

        require 'backend/dbconfig.php';

        $conn = mysqli_connect($host, $user, $pass, $dbname);
        if (!$conn) {
            die("Connessione al database fallita: " . mysqli_connect_error());
        }

        $query= "SELECT * FROM progetto WHERE IDProgetto='$id'";
        $query2 = "SELECT * FROM riferimento WHERE IDProgetto='$id'";
        $query3 = "SELECT * FROM e INNER JOIN tipoprogetto ON e.IDTipoProgetto = tipoprogetto.IDTipoProgetto WHERE IDProgetto='$id'";
        //echo $query;
        $execute = mysqli_query($conn,$query);
        $execute2 = mysqli_query($conn,$query2);
        $execute3 = mysqli_query($conn,$query3);
        //print_r($execute);

        $titolo = "";
        $descrizione = "";
        $annoinizio = "";
        $annofine = "";
        $docenti = "";
        $classi = "";

        $riferimenti = [];
        $ref = [];
        $tipi = [];
        
        if(mysqli_num_rows($execute)>0) {
            $riga=mysqli_fetch_array($execute, MYSQLI_ASSOC);

            $titolo = $riga['TitoloProg'];
            $descrizione = $riga['DescProg'];
            $annoinizio = $riga['AnnoInizio'];
            $annofine = $riga['AnnoFine'];
            $docenti = $riga['DocentiReferenti'];
            $classi = $riga['classi'];
            

        
        }else{
            header('Location: visita.php');
        }
        //echo(mysqli_num_rows($execute2));

        if(mysqli_num_rows($execute2)>0) {
            for ($i=0; $i < mysqli_num_rows($execute2); $i++) { 
                //$ref = [];
                $riga=mysqli_fetch_array($execute2, MYSQLI_ASSOC);
                //print_r($riga);

                $ref[0] = $riga['Titolo'];
                if(str_contains($riga['Descrizione'], 'http') == true || str_contains($riga['Descrizione'], 'https') == true){
                    $ref[1] = '<a href="'.$riga['Descrizione'].'">'.$riga['Descrizione'].'</a>';
                }else{
                    $ref[1] = $riga['Descrizione'];
                }
                

                array_push($riferimenti, $ref);
            }
        
        }

        if(mysqli_num_rows($execute3)>0) {
            for ($i=0; $i < mysqli_num_rows($execute3); $i++) { 
                $riga=mysqli_fetch_array($execute3, MYSQLI_ASSOC);
                //print_r($riga);

                array_push($tipi, $riga["Nome"]);
            }
        
        }

        mysqli_close($conn);


    }else{
        header('Location: visita.php');
    }

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Progetto | Museo IIS Falcone Righi</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Immagini/fav-icon.png" type="image/png">
    <link rel="stylesheet" href="Stylesheets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="Js/menu.js"></script>
    <script src="Js/slideshow.js"></script>
</head>

<body>
    <menu onclick="openMenu()">
        <h3>MENU</h3>
        <div class="span-container">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </menu>
    <nav>
        <div class="links-container">
            <a href="index.html">Home</a>
            <a href="visita.php">Visita</a>
            <a href="login.php">Accedi</a>
        </div>
        <div class="social-container">
            <a href="https://www.iisfalcone-righi.edu.it/" target="_blank"><img src="Immagini/logo-google.svg" alt="Sito Web IIS Falcone Righi"></a>
            <a href="https://www.facebook.com/IISFalconeRighi" target="_blank"><img src="Immagini/logo-facebook.svg" alt="Facebook IIS Falcone Righi"></a>
            <a href="https://www.youtube.com/channel/UCzV_gOuj3kwfM1T7_virJkQ" target="_blank"><img src="Immagini/logo-youtube.svg" alt="YouTube IIS Falcone Righi"></a>
            <a href="https://twitter.com/iisfalconerighi" target="_blank"><img src="Immagini/logo-twitter.svg" alt="Twitter IIS Falcone Righi"></a>
        </div>
    </nav>

    <div class="container-progetto">
        <div class="progetto-div-left">
            <div class="slideshow-container">
                <div class="slideshow-slide">
                    <img src="Immagini/Resq.jpg">
                </div>
                <div class="slideshow-slide">
                    <img src="Immagini/aula_magna.jpg">
                </div>
                <div class="slideshow-slide">
                    <img src="Immagini/home-test.png">
                </div>
                <a class="prev" onclick="previousSlide()">&#10094;</a>
                <a class="next" onclick="nextSlide()">&#10095;</a>
            </div>

            <hr class="hr-progetto-left">
        </div>
    
        <div class="progetto-div-right">
            <div class="content-container">
                <h2 class="titolo-progetto"><?php echo($titolo); ?></h2>
                <h3 class="anno-progetto"><?php if($annoinizio == $annofine) { echo($annoinizio); } else {echo($annoinizio.' - '.$annofine);}  ?></h3>
                <h3 class="anno-progetto"><?php for ($i=0; $i < count($tipi); $i++) { 
                    if($i == 0){echo($tipi[$i]);}else{echo(", ".$tipi[$i]);}} ?></h3>
                <p><?php echo($descrizione); ?></p>
                <?php
                    for ($i=0; $i < count($riferimenti); $i++) { 
                        echo('<div class="riferimento">
                        <h3 class="anno-progetto">'.$riferimenti[$i][0].'</h3>
                        <p>'.$riferimenti[$i][1].'<p></div>');        
                    }

                
                ?>
                <div class="riferimento">
                    <h3 class="anno-progetto"></h3>
                    <p></p>
                </div>
                <hr class="hr-progetto-right">
                <br><br>
            </div>
        </div>
    </div>
</body>
</html>