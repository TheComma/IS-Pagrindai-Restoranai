<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Patiekalų sąrašas</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./Content/css/bootstrap.min.css">
	<link rel="stylesheet" href="./Content/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="./Content/style.css">
	<script src='./Scripts/js/jquery-2.2.4.min.js' type='text/javascript'></script>
  	<script src='./Scripts/js/bootstrap.min.js' type='text/javascript'></script>
	<script type="text/javascript" src="./Scripts/js/moment.min.js"></script>
	<script src='./Scripts/js/bootstrap-datetimepicker.min.js' type='text/javascript'></script>
</head>
<body>
	<?php include("Includes/navbar.php")  ?>
	<div class="container">
		<div class="row" style="padding-bottom:10px;">
			<form class="form" method="GET" action="suvalgytu_produktu_fiksavimas.php">
				<div class='col-md-8'>
					<label class="col-md-5 control-label" for="start">Pasirinkite fiksavimo datą</label>
					<div class='input-group date' id='datetimepicker'>
						<input name="data" type='text' id="start" class="form-control" />
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Fiksuoti produktus</button>
			</form>
		</div>
	</div>
	<script>
		$('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true 
        });
	</script>
</body>
</html>