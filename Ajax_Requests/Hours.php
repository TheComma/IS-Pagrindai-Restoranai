<?php
  $dbc = mysqli_connect('localhost', 'root', '','restoranai-db');
  if(!$dbc ){
    die('Negaliu prisijungti: '.mysqli_error($dbc));
  }
  if (mysqli_connect_errno()) {
  die('Connect failed: '.mysqli_connect_errno().' : '.mysqli_connect_error());
  }
  $date = $_POST['date'];
  $query = "SELECT valandos FROM rezervacijos_valandos";
  $result = mysqli_query($dbc, $query);
  echo '<select id="hour" name="reservation_hour" class="form-control" required="">';
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    if($date == date('Y-m-d') && $row['valandos'] > date("H:i:s", time() + 7200))
      echo '<option value=\"'.$row['id'].'">'.$row['valandos'].'</option>';
    elseif($date != date('Y-m-d'))
      echo '<option value=\"'.$row['id'].'">'.$row['valandos'].'</option>';
    }
  echo "</select>";
?>
