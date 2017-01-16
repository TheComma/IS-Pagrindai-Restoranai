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
  $id = $_GET['id'];
  $query = "SELECT * FROM rezervacija WHERE id = '$id'";
  $result = mysqli_query($dbc,$query);
  $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $rezerv_data = $data['data'];
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
  <form action="./Controllers/Rezervavimu_valdiklis.php" method="post" class="form-horizontal">
    <fieldset>

      <!-- Form Name -->
			<div class="col-md-12" style="text-align: center;">
      	<legend>Rezervacijos redagavimas</legend>
			</div>
			<input type="hidden" name="erezerv" value="1" />
      <?php
      $query = "SELECT id,miestas,adresas FROM restoranas";
      $result = mysqli_query($dbc, $query);
       ?>

       <input type="hidden" name="id" value=<?php echo $id;?>>
      <!-- Select Basic -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="restaurant">Restoranas</label>
        <div class="col-md-4">
          <select id="restaurant" name="restaurant" class="form-control" required="">
        <option value=""></option>
        <?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
        <option value=<?php echo $row['id'];
        if($data['fk_restoranas'] == $row['id']) {echo' selected';} ?>><?php echo $row['adresas']." ".$row['miestas'] ?></option>
        <?php } ?>
        </select>
      </div>
     </div>

      <!-- Text input-->
      <div class="form-group">
      	<label class="col-md-4 control-label" for="reservationdate">Rezervacijos data</label>
      	<div class="col-md-4">
      		<input id="reservationdate" name="reservationdate" type="text" value=<?php echo $data['data']; ?> placeholder="Data" class="form-control input-md" required="">

      	</div>
      </div>

			<div class="form-group">
				<label class="col-md-4 control-label" for="reservationhour">Rezervacijos laikas</label>
				<div id="hland" class="col-md-4">
					<select id="reservationhour" name="reservationhour" class="form-control" required="">
						<option value=""></option>
					</select>
				</div>
			</div>

			<div class="form-group">
      	<label class="col-md-4 control-label" for="people">Žmonių kiekis</label>
      	<div class="col-md-1">
      		<input id="people" name="people" type="number" value=<?php echo $data['zmoniu_skaicius']; ?> placeholder="" class="form-control input-md" required="">
      	</div>
      </div>

		 <div class="form-group">
  	 	<label class="col-md-4 control-label" for="textarea">Komentarai</label>
  			<div class="col-md-4">
    			<textarea class="form-control" id="comments" name="comments"><?php echo $data['komentarai']; ?></textarea>
  			</div>
		</div>

		<div class="form-group">
	    <div class="col-md-12 text-center">
	      <input type="submit" value='Rezervuoti' class="btn btn-primary"  />
	    </div>
	  </div>

      </fieldset>
    </form>
  <script src='./Scripts/js/jquery-2.2.4.min.js' type='text/javascript'></script>
  <script src='./Scripts/js/bootstrap-datetimepicker.min.js' type='text/javascript'></script>
  <script src='./Scripts/js/bootstrap.min.js' type='text/javascript'></script>
  <script>
  $('#reservationdate').datetimepicker({
    format: 'YYYY-MM-DD'
  });
	$('#reservationdate').data("DateTimePicker").minDate(new Date());</script>
	<script src='./Scripts/Scripts.js' type="text/javascript"></script>
</body>
</html>
