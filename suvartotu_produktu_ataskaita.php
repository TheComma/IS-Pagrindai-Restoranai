<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if(!isset($_SESSION["userType"]) || !isset($_SESSION["userType"]) || !isset($_SESSION['userRefId'])){
      header('Location: index.html');
    }
    elseif($_SESSION["userType"] != 9 && !isset($_SESSION["restaurantId"])){
      header('Location: mainMenu.php');
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
  <link rel="stylesheet" href="./Content/css/bootstrap-datetimepicker.min.css">
  <script type="text/javascript" src="./Scripts/js/moment.min.js"></script>
  <script src='./Scripts/js/jquery-2.2.4.min.js' type='text/javascript'></script>
  <script src='./Scripts/js/bootstrap.min.js' type='text/javascript'></script>
  <script src='./Scripts/js/bootstrap-datetimepicker.min.js' type='text/javascript'></script>
  <script src='./Scripts/Scripts.js' type='text/javascript'></script>
</head>
<body>
    <?php include("Includes/navbar.php")  ?>
  <form>
  <div class="container">
  <div class="form-group">
	<label class="col-md-2 control-label" for="password">Pasirinkite darbuotoją, kurio suvartotų produktų ataskaitą norite matyti:</label>
    <div class="col-md-2">
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
  
    <div class='col-md-3'>
            <label class="col-md-4 control-label" for="start">Periodo pradžia</label>
            <div class='input-group date' id='datetimepicker6'>
                <input type='text' id="start" class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

    <div class='col-md-3'>
        <div class="form-group">
            <label class="col-md-4 control-label" for="end">Periodo pabaiga</label>
            <div class='input-group date' id='datetimepicker7'>
                <input type='text' id="end" class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
  <div class="col-md-2">
    <div class="form-group">
      <div class="col-md-2 text-center">
        <button type="button" class="btn btn-default" id="getData2">Gauti duomenis</button>
      </div>
    </div>
  </div>
  </div>
  </form>
  <div id="landing2"></div>
</div>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker6').datetimepicker({
          format: 'YYYY-MM-DD'
        });
        $('#datetimepicker7').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
</body>
</html>
