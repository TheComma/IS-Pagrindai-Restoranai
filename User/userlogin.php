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
    $passwordhash = md5($password);
		$sql = "SELECT * FROM vartotojas WHERE vartotojo_vardas = '$username' AND slaptazodis = '$passwordhash'";
    $result = mysqli_query($dbc, $sql);
		$row = mysqli_fetch_row($result);
    $data = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'];
	  if (mysqli_num_rows($result) == 0 || $row[6]) {
      $sql = "INSERT INTO prisijungimu_istorija (data, ip_adresas, ar_pavyko,fk_vartotojas) VALUES ('$data','$ip','0''1')";
      $re = mysqli_query($dbc,$sql);
      $dbc->close();
      header('Location: ../index.php');
    }
	  else {
      $sql = "INSERT INTO prisijungimu_istorija (data, ip_adresas, ar_pavyko,fk_vartotojas) VALUES ('$data','$ip','1''1')";
      $re = mysqli_query($dbc,$sql);
      session_start();
      if($row[3] == 9){
        $sql = "SELECT id FROM restoranas WHERE fk_administratorius = '$row[4]'";
        $result = mysqli_query($dbc,$sql);
        $id = mysqli_fetch_row($result);
        $_SESSION["restaurantId"] = $id[0];
      }
      $_SESSION["userType"] = $row[3];
      $_SESSION["userId"] = $row[0];
			$_SESSION["userRefId"] = $row[4];
      $dbc->close();
      header('Location: ../mainMenu.php');
	  }
  }
?>
