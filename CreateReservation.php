<?php
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
    	if(!isset($_SESSION["userType"]) || !isset($_SESSION["userType"])){
      	header('Location: ./index.html');
    	}
		}
	$dbc = mysqli_connect('localhost', 'root', '','restoranai-db');
	if(!$dbc ){
		die('Negaliu prisijungti: '.mysqli_error($dbc));
	}
	if (mysqli_connect_errno()) {
	die('Connect failed: '.mysqli_connect_errno().' : '.mysqli_connect_error());
	}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Klientų registracija</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./Content/css/bootstrap.min.css">
  <link rel="stylesheet" href="./Content/style.css">
  <link rel="stylesheet" href="./Content/css/bootstrap-datetimepicker.min.css">
  <script type="text/javascript" src="./Scripts/js/moment.min.js"></script>
</head>
<body>
  <?php include("./Includes/navbar.php")  ?>
  <form class="form-horizontal">
    <fieldset>

      <!-- Form Name -->
      <legend>Rezervacijos sukūrimas</legend>

      <?php
      $query = "SELECT id,miestas,adresas FROM restoranas";
      $result = mysqli_query($dbc, $query);
       ?>

      <!-- Select Basic -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="restaurant">Restoranas</label>
        <div class="col-md-4">
          <select id="restaurant" name="restaurant" class="form-control">
        <option value=""></option>
        <?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
        <option value=<?php echo $row['id']; ?>><?php echo $row['adresas']." ".$row['miestas'] ?></option>
        <?php } ?>
        </select>
      </div>
     </div>

      <!-- Text input-->
      <div class="form-group">
      <label class="col-md-4 control-label" for="reservationdate">Rezervacijos data</label>
      <div class="col-md-4">
      <input id="reservationdate" name="reservationdate" type="text" placeholder="Data" class="form-control input-md" required="">

      </div>
      </div>

      </fieldset>
    </form>
  <script src='./Scripts/js/jquery-2.2.4.min.js' type='text/javascript'></script>
  <script src='./Scripts/js/bootstrap-datetimepicker.min.js' type='text/javascript'></script>
  <script src='./Scripts/js/bootstrap.min.js' type='text/javascript'></script>
  <script>
  var date = new Date();
  date.setDate(date.getDate()-1);
  $('#reservationdate').datetimepicker({
    format: 'YYYY-MM-DD'
  });
	$('#reservationdate').data("DateTimePicker").minDate(new Date());</script>
</body>
</html>
