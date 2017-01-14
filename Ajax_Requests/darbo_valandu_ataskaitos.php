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
  $vartotojas = $_POST['vart'];
  $query = "SELECT isdirbtas_laikas.data AS data, isdirbtas_laikas.pradzia AS pradzia, isdirbtas_laikas.pabaiga AS pabaiga, isdirbtas_laikas.komentarai AS komentarai, isdirbtas_laikas.uzdarbis AS uzdarbis FROM isdirbtas_laikas WHERE fk_padavejas = '$vartotojas' AND data >= '$start' AND data <= '$end'";
  $result = mysqli_query($dbc,$query);
  if (mysqli_num_rows($result) > 0){
  echo '<table class="table">';
  echo '<thead><tr><th>Data</th><th>Pradėjo darbą</th><th>Baigė darbą</th><th>Darbo valandos</th><th>Komentarai</th><th>Uždarbis</th></tr></thead><tbody>';
  while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
	  $isdirbta = strtotime($row[2])-strtotime($row[1]);
	  $isdirbtaval = $isdirbta/3600;
	  $visoval = 0;
	  $visoval += $isdirbtaval;
    echo '<tr><td>'.$row[0].'</td><td>' . $row[1] . '</td><td>' . $row[2] . '</td><td>' . $isdirbtaval .'</td><td>' .$row[3]. '</td><td>' .$row[4].'</td></tr>';
  }
  echo '</tbody></table>';
  echo '<h5>Pasirinktu laikotarpiu darbuotojas viso dirbo: ' . $visoval . ' valandų.</h5>';
  }
  else{
	  echo '<div class = "row"><div class = "col-md-12"><h5>Pasirinktu laikotarpiu duomenų nėra.</h5></div></div>';
  }
?>
