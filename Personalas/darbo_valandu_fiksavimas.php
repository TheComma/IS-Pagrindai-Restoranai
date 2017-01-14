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
    print_r($_POST);
  $diena = $_POST['diena'];
  $laikas_pradzia = $_POST['laikas_pradzia'];
  $laikas_pabaiga = $_POST['laikas_pabaiga'];
  $komentaras = $_POST['komentaras'];
  $employeeid = $_SESSION["userRefId"];
  
  $sql = "SELECT * FROM isdirbtas_laikas WHERE data = '$diena'";
  $result = mysqli_query($dbc, $sql);
  print_r($result);
  if (mysqli_num_rows($result) == 0) {
    $sql = "INSERT INTO isdirbtas_laikas (data,pradzia,pabaiga,komentarai,fk_padavejas) VALUES ('$diena','$laikas_pradzia','$laikas_pabaiga','$komentaras','$employeeid')";
    $result = mysqli_query($dbc, $sql);
	print_r($result);
    if($result){
      header('Location: ../mainMenu.php');
    }
  }
  else {
    $dbc->close();
    session_start();
    $_SESSION["errmsg"] = "Tokia data laikas jau užfiksuotas";
    header('Location: ../isdirbto_laiko_fiksavimas.php');
  }
}
?>
