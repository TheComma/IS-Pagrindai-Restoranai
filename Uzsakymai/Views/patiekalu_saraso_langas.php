 <!DOCTYPE html>
<html>
<head>
	<title>Patiekalų sąrašas</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./Content/css/bootstrap.min.css">
	<link rel="stylesheet" href="./Content/style.css">
	<script src='./Scripts/js/jquery-2.2.4.min.js' type='text/javascript'></script>
  	<script src='./Scripts/js/bootstrap.min.js' type='text/javascript'></script>
</head>
<body>
	<?php include("Includes/navbar.php")  ?>
	<div class="container">
		<div class="row" style="padding-bottom:10px;">
			<div class="col-md-offset-1">
				<button id="myBtn" class="btn btn-primary">Kurti patiekalą</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<?php if (count($dishes) > 0) { ?>
				<table class="table">
					<tr>
						<th>Produktas</th>
						<th>Kaina</th>
						<th>Būsena</th>
					</tr>
					<?php foreach($dishes as $dish) { ?>
						<tr>
							<td><?php echo $dish['pavadinimas'] ?></td>
							<td><?php echo $dish['kaina'] ?></td>
							<td><?php echo $dish['aktyvus'] > 0 ? "Aktyvus" : "Neaktyvus"; ?></td>
						</tr>
					<?php } ?>
				</table>
				<?php
					if ($pageCount > 1) {
						include("Includes/pagination.php");

						echo paginate($page, $pageCount, "", 2);
					}
				?>
				<?php } else { ?>
					<h3 class="text-center">Patiekalų nėra</h3>
				<?php } ?>
			</div>
		</div>
	</div>
	<script>
        $(document).ready(function(){
            $("#myBtn").click(function(){
                window.location.href = "patiekalo_kurimas.php";
            });
        });
    </script>
</body>
</html>