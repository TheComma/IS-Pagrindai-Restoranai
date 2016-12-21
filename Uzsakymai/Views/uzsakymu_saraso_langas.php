<!DOCTYPE html>
<html>
<head>
	<title>Užsakymų sąrašas</title>
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
				<button id="myBtn" class="btn btn-primary">Kurti užsakymą</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<?php if (count($orderList) > 0) { ?>
				<table class="table">
					<tr>
						<th>Staliukas</th>
						<th>Padavėjas</th>
						<th>Būsena</th>
						<th> </th>
					</tr>
					<?php foreach($orderList as $order) { ?>
						<tr>
							<td><?php echo $order['fk_staliukas'] ?></td>
							<td><?php echo $order['padVardas'] . ' ' . $order['padPavarde'] ?></td>
							<td><?php echo $order['busena']; ?></td>
							<td>
								<button type="submit" class="btn btn-primary" onclick="editOrder(<?php 
									echo $order['id']?>)">Redaguoti</button>
							</td>
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
                window.location.href = "uzsakymo_kurimas.php";
            });
        });

        function editOrder(x) {
			window.location.href = "uzsakymo_redagavimas.php?id=" + x;
		}
    </script>
</body>
</html>