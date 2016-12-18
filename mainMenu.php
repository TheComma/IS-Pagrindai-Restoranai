<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if(!isset($_SESSION["userType"]) || !isset($_SESSION["userType"])){
      header('Location: index.html');
    }
}
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
</head>
<body>
  <?php include("Includes/navbar.php")  ?>
  <div class="container">
    <div class="jumbotron">
      <h1>Sveiki atvykę į restoranų tinklo informacinę sistemą</h1>
      <p>
        Norėdami atlikti naudotis sistema spauskite ant funkcijų valdymo juostoje
      </p>
    </div>
  </div>
</body>
</html>
