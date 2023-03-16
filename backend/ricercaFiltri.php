<?php

    session_start();

    $query = '';

    if(isset($_GET['inizio']) && isset($_GET['fine'])){
        $inizio = $_GET['inizio'];
        $fine = $_GET['fine'];
        if(!empty($inizio) && !empty($fine)){
            $query .= ' WHERE AnnoInizio  > '. $inizio .' AND AnnoFine < '. $fine;
        }
    }

    if(isset($_GET['classe'])){
        $classe = $_GET['classe'];
        if(!empty($classe)){
            $query .= ' WHERE classi LIKE "%'. $classe.'%"';
        }
    }

    if(isset($_GET['docente'])){
        $docente = $_GET['docente'];
        if(!empty($docente)){
            $query .= ' WHERE DocentiReferenti = '. $docente;
        }
    }

    $query .=';';

    $_SESSION['filtraProgetto'] = $query;

    header('Location: ../visita.php');
?>