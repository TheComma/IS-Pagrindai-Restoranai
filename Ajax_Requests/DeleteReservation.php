<?php
$dbc = mysqli_connect('localhost', 'root', '','restoranai-db');
if(!$dbc ){
  die('Negaliu prisijungti: '.mysqli_error($dbc));
}
if (mysqli_connect_errno()) {
die('Connect failed: '.mysqli_connect_errno().' : '.mysqli_connect_error());
}
$data = $_POST['id'];
$query = "DELETE FROM rezervacija WHERE id = '$data'";
$result = mysqli_query($dbc,$query);
 ?>
