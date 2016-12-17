<?php
$dbc = mysqli_connect('localhost', 'root', '','restoranai-db');
if(!$dbc ){
  die('Negaliu prisijungti: '.mysqli_error($dbc));
}
if (mysqli_connect_errno()) {
die('Connect failed: '.mysqli_connect_errno().' : '.mysqli_connect_error());
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username']; // required
  $password = $_POST['password']; // required
  $name = $_POST['name'];
  $lastname = $_POST['lastname'];
  $adress = $_POST['adress'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $city = $_POST['city'];
  $passwordhash = md5($password);
  $sql = "SELECT * FROM vartotojas WHERE vartotojo_vardas = '$username'";
  $result = mysqli_query($dbc, $sql);
  echo mysqli_num_rows($result);
  if (mysqli_num_rows($result) == 0) {
    $sql = "INSERT INTO klientas (vardas,pavarde,telefonas,miestas,el_pastas,adresas) VALUES ('$name','$lastname','$phone','$city','$email','$adress')";
    $result = mysqli_query($dbc,$sql);
    if($result){
      $prevId = mysqli_insert_id($dbc);
      $today = date("Y-m-d H:i:s");
      $sql = "INSERT INTO vartotojas (vartotojo_vardas,slaptazodis,vartotojo_tipas,vartotojo_nuoroda,sukurimo_data,ar_blokuotas) VALUES ('$username','$passwordhash','1','$prevId','$today','false')";
      $insertresult = mysqli_query($dbc,$sql);
      if(!$insertresult){
        session_start();
        $_SESSION["errmsg"] = $dbc->error;
        $dbc->close();
        header('Location: ../klientu_registracija.php');
      }
    }
    header('Location: ../index.php');
  }
  else {
    $dbc->close();
    session_start();
    $_SESSION["errmsg"] = "Toks vartotojo vardas jau yra";
    header('Location: ../klientu_registracija.php');
  }
}
?>
