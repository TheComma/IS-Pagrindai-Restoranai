<?php
  $dbc = mysqli_connect('localhost', 'root', '','restoranai-db');
  if(!$dbc ){
    die('Negaliu prisijungti: '.mysqli_error($dbc));
  }
  if (mysqli_connect_errno()) {
  die('Connect failed: '.mysqli_connect_errno().' : '.mysqli_connect_error());
  }
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $restaurant = $_POST['restaurant']; // required
    $reservationdate = $_POST['reservationdate']; // required
    $reservationhour = $_POST['reservationhour'];
    $people = $_POST['people'];
    $comments = $_POST['comments'];
    $clientid = $_SESSION["userRefId"];
    $query = "SELECT staliukas.staliuko_indentifikatorius FROM staliukas WHERE staliukas.staliuko_indentifikatorius NOT IN(SELECT fk_staliukas FROM rezervacija WHERE fk_valandos = '$reservation_hour')";
    $result = mysqli_query($dbc,$query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    echo $row['staliuko_indentifikatorius'];
    $staliukas = $row['staliuko_indentifikatorius'];

    $data = date('Y-m-d H:i:s');
    $query = "INSERT INTO rezervacija (data,sukurimo_data,pakeitimo_data,zmoniu_skaicius,	komentarai,fk_valandos,fk_klientas,fk_restoranas,fk_busena,fk_staliukas) VALUES".
    "('$reservationdate','$data','$data','$people','$comments','$reservationhour','$clientid','$restaurant',1,'$staliukas')";
    $result = mysqli_query($dbc,$query);
    $dbc->close();
    if($result){
     header('Location: ../mainMenu.php');
    }
    else{
      header('Location:  '. $_SERVER['HTTP_REFERER']);
    }

 }
 ?>
