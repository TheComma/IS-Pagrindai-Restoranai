<!DOCTYPE html>
<html>
<head>
	<title>Užsakytų produktų sąrašas</title>
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
		<?php if ($_SESSION['userType'] == KITCHEN_LEVEL) { ?>
			<div class="row" style="padding-bottom:10px;">
				<button id="myBtn" class="btn btn-primary">Užsakyti produktus</button>
			</div>
		<?php } ?>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<?php if (count($orders) > 0) { ?>
				<table class="table">
					<tr>
						<th>Produktas</th>
						<th>Kiekis</th>
						<th>Būsena</th>
						<th></th>
						<th></th>
					</tr>
					<?php foreach($orders as $order) { ?>
						<tr>
							<td>
								<input class="orderId" type="text" hidden disabled value="<?php echo $order['id']; ?>"/>
								<?php echo $order['produktoPav'] ?>
							</td>
							<td><?php echo $order['kiekis'] ?></td>
							<td><?php echo $order['busena'] ?></td>
							<td>
								<?php if ($_SESSION['userType'] == ADMIN_LEVEL && $order['busena'] == "Sukurtas") { ?>
										<button class="btn btn-primary confirmButton" type="button">Tvirtinti</button>
								<?php } ?>
							</td>
							
							<td>
								<?php if ($_SESSION['userType'] == ADMIN_LEVEL && $order['busena'] == "Sukurtas") { ?>
										<button class="btn btn-primary cancelButton" type="button">Atmesti</button>
								<?php } ?>
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
					<h3 class="text-center">Užsakymų nėra</h3>
				<?php } ?>
			</div>
		</div>
	</div>
	<script>
        $(document).ready(function(){
            $(".confirmButton").click(function(){
               var id = $(this).closest('tr').find(".orderId").val();

				dataid = "id="+id+"&status=2";
				//console.log(id);
				$.ajax({
					type: "POST",
					url: "./Ajax_Requests/OrderStatus.php",
					data: dataid,
					cache: false,
					success: function(data){
						window.location.href =  window.location.href;
					}
				});
            });

			 $(".cancelButton").click(function(){
               var id = $(this).closest('tr').find(".orderId").val();

				dataid = "id="+id+"&status=3";
				//console.log(id);
				$.ajax({
					type: "POST",
					url: "./Ajax_Requests/OrderStatus.php",
					data: dataid,
					cache: false,
					success: function(data){
						window.location.href =  window.location.href;
					}
				});
            });
        });
    </script>
</body>
</html>