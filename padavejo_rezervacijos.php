<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if(!isset($_SESSION["userType"]) || !isset($_SESSION["userType"]) || !isset($_SESSION['userRefId'])){
      header('Location: index.html');
    }
    elseif($_SESSION["userType"] != 5){
      header('Location: mainMenu.php');
    }
}
$dbc = mysqli_connect('localhost', 'root', '','restoranai-db');
if(!$dbc ){
  die('Negaliu prisijungti: '.mysqli_error($dbc));
}
if (mysqli_connect_errno()) {
die('Connect failed: '.mysqli_connect_errno().' : '.mysqli_connect_error());
}
$waiterId = $_SESSION['userRefId'];
$query = "SELECT rezervacija.data, rezervacija.zmoniu_skaicius,rezervacija.komentarai,rezervacijos_valandos.valandos,restoranas.adresas,restoranas.miestas,rezervacija.id FROM rezervacija,rezervacijos_valandos,restoranas,staliukas,padavejas WHERE fk_busena = 2 AND padavejas.id = '$waiterId' AND staliukas.fk_padavejas = padavejas.id AND fk_staliukas = staliukas.staliuko_indentifikatorius AND rezervacija.fk_valandos = rezervacijos_valandos.id AND rezervacija.fk_restoranas = restoranas.id";
$result = mysqli_query($dbc,$query);
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./Content/css/bootstrap.min.css">
  <link rel="stylesheet" href="./Content/style.css">
  <script src='./Scripts/js/jquery-2.2.4.min.js' type='text/javascript'></script>
  <script src='./Scripts/js/bootstrap.min.js' type='text/javascript'></script>
  <script src='./Scripts/Scripts.js' type='text/javascript'></script>
</head>
<body>
  <?php include("Includes/navbar.php")  ?>
  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th>Rezervacijos data</th>
          <th>Rezervacijos laikas</th>
          <th>Restoranas</th>
          <th>Žmonių kiekis</th>
          <th>Komentarai</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
        {
        echo '<tr id='.$row[6].'>'
        .'<td>'.$row[0].'</td>'
        .'<td>'.$row[3].'</td>'
        .'<td>'.$row[4].' '.$row[5].'</td>'
        .'<td>'.$row[1].'</td>'
        .'<td>'.$row[2].'</td>';
        }
        $dbc->close();
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
