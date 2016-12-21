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
$rId = $_SESSION["restaurantId"];
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
  <input type="hidden" id="restaurant" name="restaurant" value=<?php echo $rId; ?> />
    <div class='col-md-4'>
        <div class="form-group">
            <label class="col-md-4 control-label" for="start">Periodo pradžia</label>
            <div class='input-group date' id='datetimepicker6'>
                <input type='text' id="start" class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-4'>
        <div class="form-group">
            <label class="col-md-4 control-label" for="end">Periodo pradžia</label>
            <div class='input-group date' id='datetimepicker7'>
                <input type='text' id="end" class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
  <div class="col-md-4">
    <div class="form-group">
      <div class="col-md-4 text-center">
        <button type="button" class="btn btn-default" id="getData">Gauti duomenis</button>
      </div>
    </div>
  </div>
  </form>
  <div id="landing"></div>
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
