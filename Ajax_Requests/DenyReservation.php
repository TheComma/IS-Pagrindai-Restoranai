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
$query = "SELECT * FROM klientas WHERE id = '$clientId'";
$result = mysqli_query($dbc,$query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$mailer->sendDeny($row['vardas']." ".$row['pavarde'],$row['el_pastas']);
 ?>
