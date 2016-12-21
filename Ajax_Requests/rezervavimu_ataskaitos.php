<?php
  $dbc = mysqli_connect('localhost', 'root', '','restoranai-db');
  if(!$dbc ){
    die('Negaliu prisijungti: '.mysqli_error($dbc));
  }
  if (mysqli_connect_errno()) {
  die('Connect failed: '.mysqli_connect_errno().' : '.mysqli_connect_error());
  }
  $start = $_POST['start'];
  $end = $_POST['end'];
  $restoranas = $_POST['rest'];
  $query = "SELECT rezervacija.data, COUNT(*) FROM rezervacija WHERE fk_restoranas = '$restoranas' AND data >= '$start' AND data <= '$end' GROUP BY data";
  $result = mysqli_query($dbc,$query);
  echo '<table class="table">';
  echo '<thead><tr><th>Data</th><th>Rezervacijos</th></tr></thead><tbody>';
  while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
    echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
  }
  echo '</tbody></table>';
?>
