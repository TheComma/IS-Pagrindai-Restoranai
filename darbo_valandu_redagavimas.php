<?php
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
    	if(!isset($_SESSION["userType"]) || !isset($_SESSION["userId"])){
      	header('Location: ./index.php');
    	}
		}
?>
<!DOCTYPE html>
<html>
<head>
	 <title>Išdirbto laiko fiksavimas</title>
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
  <form action="./Personalas/darbo_valandu_fiksavimas.php" method="post" class="form-horizontal">
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
													print "<option value='" . $row['id'] . "'>" . $row['vardas'] . " " . $row['pavarde'] ."</option>";
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
    <input id="data" name="data" type="date" step="any" min="0"  class="form-control input-md" required="">
    </div>
  </div>
  
    <div class="form-group">
	<label class="col-md-4 control-label" for="laikas_pradzia">Pasirinkite darbo pradžios laiką:</label>
    <div class="col-md-4">
      <input id="laikas_pradzia" name="laikas_pradzia" type="time" class="form-control input-md" required="">
    </div>
  </div>
  
  <div class="form-group">
	<label class="col-md-4 control-label" for="laikas_pabaiga">Pasirinkite darbo pabaigos laiką:</label>
    <div class="col-md-4">
      <input id="laikas_pabaiga" name="laikas_pabaiga" type="time" class="form-control input-md" required="">
    </div>
  </div>
  
   <div class="form-group">   
	<label class="col-md-4 control-label" for="komentaras">Komentaras:</label>
    <div class="col-md-4">
      <input id="komentaras" name="komentaras" type="text" class="form-control input-md" required="">
    </div>
  </div>
  
     <div class="form-group">   
	<label class="col-md-4 control-label" for="uzdarbis">Uždarbis:</label>
    <div class="col-md-4">
      <input id="uzdarbis" name="uzdarbis" type="number" step="any" class="form-control input-md" required="">
    </div>
  </div>
  
    <div class="col-md-12 text-center">
      <input type="submit" value='Patvirtinti' class="btn btn-primary"  />
    </div>
  </div>
  </fieldset>
  </form>
</div>
</body>
</html>