<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if(!isset($_SESSION["userType"]) || !isset($_SESSION["userId"])){
      header('Location: ./index.php');
    }
  }

  $user = "";
  $date = "";
  $isset = false;
  $missing = false;
  $updated = false;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = isset($_POST['vartotojas']) ? $_POST['vartotojas'] : null;
    $date = isset($_POST['data']) ? $_POST['data'] : null;
    $start = isset($_POST['laikas_pradzia']) ? $_POST['laikas_pradzia'] : null;
    $end = isset($_POST['laikas_pabaiga']) ? $_POST['laikas_pabaiga'] : null;
    $comment = isset($_POST['komentaras']) ? $_POST['komentaras'] : null;
    $salary = isset($_POST['uzdarbis']) ? $_POST['uzdarbis'] : null;

    $isset = $user && $date ? true : false;
    $values = array();

    if ($isset && $start && $end && $comment && $salary){
      $conn = mysqli_connect('localhost', 'root', '','restoranai-db');
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      
      // For Unicode to work properly, as MySQL doesn't default to Unicode
      mysqli_set_charset($conn, "utf8");
      
      // Escape the string to avoid stuff like quotes from messing SQL up
      $comment = mysqli_real_escape_string($conn, $comment);

      $query = "UPDATE isdirbtas_laikas SET pradzia = '$start', pabaiga = '$end', komentarai = '$comment', uzdarbis = '$salary'
                WHERE fk_padavejas = $user AND data = '$date'";
      $result = mysqli_query($conn, $query);

      $updated = true;
    } else if ($isset) {
      $conn = mysqli_connect('localhost', 'root', '','restoranai-db');
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      
      // For Unicode to work properly, as MySQL doesn't default to Unicode
      mysqli_set_charset($conn, "utf8");

      $query = "SELECT * FROM `isdirbtas_laikas` WHERE fk_padavejas = $user AND data = '$date' LIMIT 1";
      $result = mysqli_query($conn, $query);

      if(mysqli_num_rows($result) > 0){
        while($row =  mysqli_fetch_assoc($result)){
          $start = $row['pradzia'];
          $end = $row['pabaiga'];
          $comment = $row['komentarai'];
          $salary = $row['uzdarbis'];
        }
      } else {
        $isset = false;
        $missing = true;
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Išdirbto laiko redagavimas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./Content/css/bootstrap.min.css">
  <link rel="stylesheet" href="./Content/style.css">
  <link rel="stylesheet" href="./Content/css/bootstrap-datetimepicker.min.css">
  <script type="text/javascript" src="./Scripts/js/moment.min.js"></script>
  <script src='./Scripts/js/jquery-2.2.4.min.js' type='text/javascript'></script>
  <script src='./Scripts/js/bootstrap.min.js' type='text/javascript'></script>
  <script src='./Scripts/js/bootstrap-datetimepicker.min.js' type='text/javascript'></script>
  <script src='./Scripts/Scripts.js' type='text/javascript'></script>
</head>
<body>
<?php include("./Includes/navbar.php")  ?>
<div class="container">
  <?php if ($missing){ ?>
    <div class="alert alert-danger">
      <p> Toks darbuotojas tuo laiku nedirbo</p>
    </div>
  <?php } else if ($updated) {?>
    <div class="alert alert-success">
      <p> Įrašas sėkmingai atnaujintas</p>
    </div>
  <?php } ?>
  <form method="post" class="form-horizontal">
  <fieldset>
  <legend>Išdirbto laiko redagavimas</legend>
  
  <div class="form-group">
	  <label class="col-md-4 control-label" for="password">Pasirinkite vartotoją, kurio darbo valandas norite redaguoti:</label>
    <div class="col-md-4">
      <select id="vartotojas" name="vartotojas" required="required">
        <?php
          $conn = mysqli_connect('localhost', 'root', '','restoranai-db');
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }

          $query="SELECT vardas, pavarde, id FROM `padavejas`";
          $result=mysqli_query($conn, $query);

          if(mysqli_num_rows($result)>0){
            while($row =  mysqli_fetch_assoc($result)){
              foreach ($result as $row) {
                $selected = $row['id'] == $user ? "selected" : "";
                print "<option value='" . $row['id'] . "' " . $selected . ">" . $row['vardas'] . " " . $row['pavarde'] ."</option>";
              }
            }
          }
        ?>
		</select>
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-md-4 control-label" for="data">Pasirinkite datą, kurios laiką norite redaguoti:</label>
    <div class="col-md-4">
      <input id="data" name="data" type="date" step="any" min="0" value="<?php echo is_null($date) ? "" : $date; ?>"  class="form-control input-md" required>
    </div>
  </div>

  <?php if ($isset){ ?>
    <div class="form-group">
      <label class="col-md-4 control-label" for="laikas_pradzia">Pasirinkite darbo pradžios laiką:</label>
      <div class="col-md-4">
        <input id="laikas_pradzia" name="laikas_pradzia" type="time" value="<?php echo $start ?>" class="form-control input-md" required="">
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-md-4 control-label" for="laikas_pabaiga">Pasirinkite darbo pabaigos laiką:</label>
      <div class="col-md-4">
        <input id="laikas_pabaiga" name="laikas_pabaiga" type="time" value="<?php echo $end ?>" class="form-control input-md" required="">
      </div>
    </div>
    
    <div class="form-group">   
      <label class="col-md-4 control-label" for="komentaras">Komentaras:</label>
      <div class="col-md-4">
        <input id="komentaras" name="komentaras" type="text" value="<?php echo $comment ?>" class="form-control input-md" required="">
      </div>
    </div>
    
    <div class="form-group">   
      <label class="col-md-4 control-label" for="uzdarbis">Uždarbis:</label>
      <div class="col-md-4">
        <input id="uzdarbis" name="uzdarbis" type="number" step="any" value="<?php echo $salary ?>" class="form-control input-md" required="">
      </div>
    </div>
  <?php }?>
  
    <div class="col-md-12 text-center">
      <?php if($isset){ ?>
        <input type="submit" value='Patvirtinti' class="btn btn-primary"  />
      <?php } else{?>
        <input type="submit" value='Gauti duomenis' class="btn btn-primary"  />
      <?php } ?>
    </div>
  </div>
  </fieldset>
  </form>
</div>
</body>
</html>