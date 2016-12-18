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
    $reservation_hour = $_POST['reservation_hour'];
    $people = $_POST['people'];
    $comments = $_POST['comments'];
    $clientid = $_SESSION["userRefId"];
    $query = "INSERT INTO rezervacija (data,sukurimo_data,pakeitimo_data,zmoniu_skaicius,	komentarai,fk_valandos,fk_klientas,fk_restoranas,fk_busena,fk_staliukas) VALUES".
    "('$reservationdate','now()','now()','$people','$comments','$reservation_hour','$clientid','$restaurant')";
 }
 ?>
