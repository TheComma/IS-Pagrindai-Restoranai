<?php
include("../Includes/mailer.php");
class Rezervavimu_valdiklis{

  function Rezervavimu_valdiklis() {
    if(isset($_POST['login'])){
      $this->prisijungti();
    }
    else if(isset($_POST['reg'])){
      $this->Uzregistruoti_vartotoja();
    }
    else if(isset($_POST['crezerv'])){
      $this->sukurti_rezervacija();
    }
    else if(isset($_POST['erezerv'])){
      $this->redaguoti_rezervacija();
    }
    else if(isset($_POST['confirm'])){
      $this->patvirtinti_rezervacija();
    }
    else if(isset($_POST['deny'])){
      $this->atmesti_rezervacija();
    }
    else if(isset($_POST['report'])){
      $this->gauti_ataskaita();
    }
    else if(isset($_POST['hours'])){
      $this->gauti_valandas();
    }
  }

  function prisijungti() {
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
  }

  function Uzregistruoti_vartotoja(){
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
  }

  function sukurti_rezervacija(){
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
  }

  function redaguoti_rezervacija(){
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
      $id = $_POST['id']; // required
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
      $query = "UPDATE rezervacija SET data='$reservationdate',pakeitimo_data='$data',zmoniu_skaicius='$people',komentarai='$comments',fk_restoranas='$restaurant',fk_valandos='$reservationhour',fk_staliukas='$staliukas' WHERE id = '$id'";
      $result = mysqli_query($dbc,$query);
      $dbc->close();
      if($result){
       header('Location: ../vartotojo_rezervacijos.php');
      }
      else{
        header('Location:  '. $_SERVER['HTTP_REFERER']);
      }
    }
  }

  function patvirtinti_rezervacija(){
    global $mailer;
    $dbc = mysqli_connect('localhost', 'root', '','restoranai-db');
    if(!$dbc ){
      die('Negaliu prisijungti: '.mysqli_error($dbc));
    }
    if (mysqli_connect_errno()) {
    die('Connect failed: '.mysqli_connect_errno().' : '.mysqli_connect_error());
    }
    $data = $_POST['id'];
    $query = "UPDATE rezervacija SET fk_busena = 2 WHERE id = '$data'";
    $result = mysqli_query($dbc,$query);
    $query = "SELECT fk_klientas FROM rezervacija WHERE id = '$data'";
    $result = mysqli_query($dbc,$query);
    $row = mysqli_fetch_array($result, MYSQLI_NUM);
    $clientId = $row[0];
    $query = "SELECT * FROM klientas Where id = '$clientId'";
    $result = mysqli_query($dbc,$query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $query = "SELECT rezervacija.data,  rezervacijos_valandos.valandos, restoranas.adresas, restoranas.miestas FROM rezervacija,rezervacijos_valandos,restoranas WHERE rezervacija.id = '$data' AND rezervacijos_valandos.id = rezervacija.fk_valandos AND restoranas.id = rezervacija.fk_restoranas";
    $result = mysqli_query($dbc,$query);
    $rev = mysqli_fetch_array($result, MYSQLI_NUM);
    $mailer->sendConfirm($row['vardas']." ".$row['pavarde'],$row['el_pastas'],$rev[2],$rev[3],$rev[1],$rev[0]);
  }

  function atmesti_rezervacija(){
    global $mailer;
    $dbc = mysqli_connect('localhost', 'root', '','restoranai-db');
    if(!$dbc ){
      die('Negaliu prisijungti: '.mysqli_error($dbc));
    }
    if (mysqli_connect_errno()) {
    die('Connect failed: '.mysqli_connect_errno().' : '.mysqli_connect_error());
    }
    $data = $_POST['id'];
    $query = "UPDATE rezervacija SET fk_busena = 2 WHERE id = '$data'";
    $result = mysqli_query($dbc,$query);
    $query = "SELECT fk_klientas FROM rezervacija WHERE id = '$data'";
    $result = mysqli_query($dbc,$query);
    $row = mysqli_fetch_array($result, MYSQLI_NUM);
    $clientId = $row[0];
    $query = "SELECT * FROM klientas WHERE id = '$clientId'";
    $result = mysqli_query($dbc,$query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $mailer->sendDeny($row['vardas']." ".$row['pavarde'],$row['el_pastas']);
  }

  function gauti_ataskaita(){
    $dbc = mysqli_connect('localhost', 'root', '','restoranai-db');
    if(!$dbc ){
      die('Negaliu prisijungti: '.mysqli_error($dbc));
    }
    if (mysqli_connect_errno()) {
    die('Connect failed: '.mysqli_connect_errno().' : '.mysqli_connect_error());
    }
    $start = $_POST['start'];
    $end = $_POST['end'];
    $restoranas = $_POST['rest'];
    $query = "SELECT rezervacija.data, COUNT(*) FROM rezervacija WHERE fk_restoranas = '$restoranas' AND data >= '$start' AND data <= '$end' GROUP BY data";
    $result = mysqli_query($dbc,$query);
    echo '<table class="table">';
    echo '<thead><tr><th>Data</th><th>Rezervacijos</th></tr></thead><tbody>';
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
      echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
    }
    echo '</tbody></table>';
  }

  function gauti_valandas(){
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
  }
}
$obj = new Rezervavimu_valdiklis();
?>
