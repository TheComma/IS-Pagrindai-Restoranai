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
  <legend>Išdirbto laiko fiksavimas</legend>
  
  <div class="form-group">
	<label class="col-md-4 control-label" for="password">Pasirinkite datą, kurioje norite fiksuoti laiką:</label>
    <div class="col-md-4">
      <input id="diena" name="diena" type="date" class="form-control input-md" required="" maxlength="20">
    </div>
  </div>
  
  <div class="form-group">
	<label class="col-md-4 control-label" for="password">Pasirinkite darbo pradžios laiką:</label>
    <div class="col-md-4">
      <input id="laikas_pradzia" name="laikas_pradzia" type="time" class="form-control input-md" required="" maxlength="20">
    </div>
  </div>
  
  <div class="form-group">
	<label class="col-md-4 control-label" for="password">Pasirinkite darbo pabaigos laiką:</label>
    <div class="col-md-4">
      <input id="laikas_pabaiga" name="laikas_pabaiga" type="time" class="form-control input-md" required="" maxlength="20">
    </div>
  </div>
    
   <div class="form-group">
	<label class="col-md-4 control-label" for="password">Komentaras:</label>
    <div class="col-md-4">
      <input id="komentaras" name="komentaras" type="text" class="form-control input-md" required="" maxlength="100">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-md-12 text-center">
      <input type="submit" value='Patvirtinti' class="btn btn-primary"  />
    </div>
  </div>
  </fieldset>
  </form>
</div>
</body>
</html>