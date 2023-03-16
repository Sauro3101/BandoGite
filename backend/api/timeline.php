<?php

require '../dbconfig.php';

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
	die("Connessione al database fallita: " . mysqli_connect_error());
}
 
 $select="SELECT progetto.annoinizio AS anno FROM progetto GROUP BY progetto.annoinizio ORDER BY progetto.annoinizio"; 
 $ris=mysqli_query($conn,$select);
 
 if (! $ris)
 {
	 echo (json_encode(array("error"=>"query fallita ".msqli_error())));
	 exit();
 }
 

 $riga=mysqli_fetch_array($ris, MYSQLI_ASSOC);
 /*
 if (!$riga)
 {
	 echo (json_encode(array("error"=>"fetch fallito")));
	 exit();
 }
 */
 $progetti = array();
 
 while ($riga)
 {
	 array_push($progetti, $riga['anno']);
	 $riga=mysqli_fetch_array($ris, MYSQLI_ASSOC);
 }
 mysqli_close($conn);
 
 header("Access-Control-Allow-Origin: *");
 header('Content-Type: application/json; charset=utf-8');
 echo(json_encode($progetti));
// echo(json_encode(array("1980","1981","1982","1983","1984","1985","1986","1987","1988","1989","1990","1991","1992","1993","1994","1995","1996","1997","1998","1999","2000","2001","2002"))); //test in attesa della popolazione del db
 ?>