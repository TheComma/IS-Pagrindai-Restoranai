<?php
include("../Includes/mailer.php");
$dbc = mysqli_connect('localhost', 'root', '','restoranai-db');
if(!$dbc ){
  die('Negaliu prisijungti: '.mysqli_error($dbc));
}
if (mysqli_connect_errno()) {
die('Connect failed: '.mysqli_connect_errno().' : '.mysqli_connect_error());
}
$data = $_POST['id'];
$query = "UPDATE rezervacija SET fk_busena = 2 WHERE id = '$data'";
$result = mysqli_query($dbc,$query);
$query = "SELECT fk_klientas FROM rezervacija WHERE id = '$data'";
$result = mysqli_query($dbc,$query);
$row = mysqli_fetch_array($result, MYSQLI_NUM);
$clientId = $row[0];
$query = "SELECT * FROM klientas Where id = '$clientId'";
$result = mysqli_query($dbc,$query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$query = "SELECT rezervacija.data,  rezervacijos_valandos.valandos, restoranas.adresas, restoranas.miestas FROM rezervacija,rezervacijos_valandos,restoranas WHERE rezervacija.id = '$data' AND rezervacijos_valandos.id = rezervacija.fk_valandos AND restoranas.id = rezervacija.fk_restoranas";
$result = mysqli_query($dbc,$query);
$rev = mysqli_fetch_array($result, MYSQLI_NUM);
$mailer->sendConfirm($row['vardas']." ".$row['pavarde'],$row['el_pastas'],$rev[2],$rev[3],$rev[1],$rev[0]);
 ?>
