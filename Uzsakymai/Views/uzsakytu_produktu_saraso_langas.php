<!DOCTYPE html>
<html>
<head>
	<title>Klientų registracija</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./Content/css/bootstrap.min.css">
	<link rel="stylesheet" href="./Content/style.css">
</head>
<body>
	<?php include("Includes/navbar.php")  ?>
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<?php if (count($orders) > 0) { ?>
				<table class="table">
					<tr>
						<th>Produktas</th>
						<th>Kiekis</th>
						<th>Būsena</th>
					</tr>
					<?php foreach($orders as $order) { ?>
						<tr>
							<td><?php echo $order['produktoPav'] ?></td>
							<td><?php echo $order['kiekis'] ?></td>
							<td><?php echo $order['busena'] ?></td>
						</tr>
					<?php } ?>
				</table>
				<?php
					if ($pageCount > 1) {
						include("Includes/pagination.php");

						echo paginate($page, $pageCount, null, 2);
					}
				?>
				<?php } else { ?>
					<h3 class="text-center">Užsakymų nėra</h3>
				<?php } ?>
			</div>
		</div>
	</div>
</body>
</html>