<?php
  $dbc = mysqli_connect('localhost', 'root', '','restoranai-db');
  if(!$dbc ){
    die('Negaliu prisijungti: '.mysqli_error($dbc));
  }
  if (mysqli_connect_errno()) {
  die('Connect failed: '.mysqli_connect_errno().' : '.mysqli_connect_error());
  }
  $date = $_POST['date'];
  $restoranas = $_POST['rest'];
  $query = "SELECT * FROM rezervacijos_valandos";
  $query1 = "SELECT * FROM staliukas WHERE fk_restoranas = '$restoranas'";
  $staliukairesult = mysqli_query($dbc,$query1);
  $staliukai = mysqli_num_rows($staliukairesult);
  $result = mysqli_query($dbc, $query);
  echo '<select id="reservationhour" name="reservationhour" class="form-control" required="">';
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $val = $row['valandos'];
    $query = "SELECT * FROM rezervacija WHERE fk_valandos = '$val'";
    $getresult = mysqli_query($dbc, $query);
    $rezervacijos = mysqli_num_rows($getresult);
    if($date == date('Y-m-d') && $row['valandos'] > date("H:i:s", time() + 7200) && $rezervacijos < $staliukai)
      echo '<option value="'.$row['id'].'">'.$row['valandos'].'</option>';
    elseif($date != date('Y-m-d') && $rezervacijos < $staliukai)
      echo '<option value="'.$row['id'].'">'.$row['valandos'].'</option>';
    }
  echo "</select>";
?>
