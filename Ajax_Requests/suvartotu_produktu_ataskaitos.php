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
  $query = "SELECT padavejo_maistas.data AS data, padavejo_maistas.kiekis AS kiekis, patiekalas.pavadinimas AS patiekalas, patiekalas.kaina AS kaina FROM padavejo_maistas, patiekalas WHERE fk_padavejas = '$vartotojas' AND padavejo_maistas.fk_patiekalas = patiekalas.id AND data >= '$start' AND data <= '$end'";
  $result = mysqli_query($dbc,$query);
  if (mysqli_num_rows($result) > 0){
  echo '<table class="table">';
  echo '<thead><tr><th>Data</th><th>Patiekalas</th><th>Kiekis</th><th>Kaina viso</th><th>Kaina darbuotojui</th></tr></thead><tbody>';
  while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
	  $kainaviso = $row[3]*$row[1];
	  $darbkaina = $kainaviso*0.7;
	  
    echo '<tr><td>'.$row[0].'</td><td>' . $row[2] . '</td><td>' . $row[1] . '</td><td>' . $kainaviso .'</td><td>' . $darbkaina . '</td></tr>';
  }
  echo '</tbody></table>';
  }
  else{
	  echo '<div class = "row"><div class = "col-md-12"><h5>Pasirinktu laikotarpiu duomenų nėra.</h5></div></div>';
  }
?>
