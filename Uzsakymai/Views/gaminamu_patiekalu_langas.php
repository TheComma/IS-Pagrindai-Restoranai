 <!DOCTYPE html>
<html>
<head>
	<title>Patiekalų gamyba</title>
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
		<div class="row">
			<div class="col-md-12">
				<?php if (count($orderList) > 0) { ?>
				<table class="table">
					<tr>
						<th>Patiekalas</th>
						<th>Staliukas</th>
						<th>Padavėjas</th>
						<th>Komentaras</th>
						<th></th>
						<th></th>
					</tr>
					<?php foreach($orderList as $order) { ?>
						<tr>
							<td><?php echo $order['pavadinimas'] ?></td>
							<td><?php echo $order['staliukoPav'] ?></td>
							<td><?php echo $order['padavejoVardas'] . ' ' .  $order['padavejoPavarde'] ?></td>
							<td style="text-wrap: normal;word-wrap: break-word;"><?php echo $order['komentaras'] ?></td>
							<td>
								<form class="form" method="POST">
									<input name="id" type="text" hidden  value="<?php echo $order['id']; ?>"/>
									<?php if ($order['fk_busena'] == 1) { ?>
										<input name="busena" type="text" hidden  value="2"/>
										<button class="btn btn-primary produceButton" type="submit">Gaminti</button>
									<?php } else if ($order['fk_busena'] == 2) { ?>
										<input name="busena" type="text" hidden  value="3"/>
										<button class="btn btn-primary finishButton" type="submit">Užbaigti</button>
									<?php } ?>
								</form>
							</td>
							<td> 
								<form class="form" method="POST">
									<input name="id" type="text" hidden  value="<?php echo $order['id']; ?>"/>
									<input name="busena" type="text" hidden value="4"/>
									<button class="btn btn-primary cancelButton" type="submit">Atšaukti</button>
								</form>
							</td>
						</tr>
					<?php } ?>
				</table>
				<?php } else { ?>
					<h3 class="text-center">Gamintinų patiekalų nėra</h3>
				<?php } ?>
			</div>
		</div>
	</div>
</body>
</html>