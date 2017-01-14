<?php
$dbc = mysqli_connect('localhost', 'root', '','restoranai-db');
if(!$dbc ){
  die('Negaliu prisijungti: '.mysqli_error($dbc));
}
if (mysqli_connect_errno()) {
die('Connect failed: '.mysqli_connect_errno().' : '.mysqli_connect_error());
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
  $employeetype = $_POST['employeetype'];
  $username = $_POST['username']; // required
  $password = $_POST['password']; // required
  $name = $_POST['name'];
  $lastname = $_POST['lastname'];
  $adress = $_POST['adress'];
  $account = $_POST['account'];
  $phone = $_POST['phone'];
  $personalcode = $_POST['personalcode'];
  $shift = $_POST['shift'];
  $startdate = $_POST['startdate'];
  $passwordhash = md5($password);
  $sql = "SELECT * FROM vartotojas WHERE vartotojo_vardas = '$username'";
  $result = mysqli_query($dbc, $sql);
  if (mysqli_num_rows($result) == 0) {
    $sql = "INSERT INTO padavejas (vardas,pavarde,adresas,saskaitos_numeris,telefonas,asmens_kodas,etatas,idarbinimo_data) VALUES ('$name','$lastname','$adress','$account','$phone','$personalcode','$shift','$startdate')";
    $result = mysqli_query($dbc, $sql);
    if($result){
      $prevId = mysqli_insert_id($dbc);
      $today = date("Y-m-d H:i:s");
      $query = "INSERT INTO vartotojas (vartotojo_vardas,slaptazodis,vartotojo_tipas,vartotojo_nuoroda,sukurimo_data,ar_blokuotas) VALUES ('$username','$passwordhash','$employeetype','$prevId','$today','0')";
      $insertresult = mysqli_query($dbc,$query);
	  print_r($insertresult);
      if(!$insertresult){
        session_start();
        $_SESSION["errmsg"] = $dbc->error;
        $dbc->close();
        header('Location: ../darbuotoju_registracija.php');
      }
    }
    header('Location: ../mainMenu.php');
  }
  else {
    $dbc->close();
    session_start();
    $_SESSION["errmsg"] = "Toks vartotojo vardas jau yra";
    header('Location: ../darbuotoju_registracija.php');
  }
}
?>
