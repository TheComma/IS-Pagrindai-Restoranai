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
								<input class="orderId" type="text" hidden disabled value="<?php echo $order['id']; ?>"/>
								<?php if ($order['busena'] == 1) { ?>
										<button class="btn btn-primary produceButton" type="button">Gaminti</button>
								<?php } else if ($order['busena'] == 2) { ?>
										<button class="btn btn-primary finishButton" type="button">Užbaigti</button>
								<?php	} ?>
							</td>
							<td> 
								<button class="btn btn-primary cancelButton" type="button">Atšaukti</button>
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
	<script>
        $(document).ready(function(){
            $(".produceButton").click(function(){
                var id = $(this).closest('tr').find(".orderId").val();

				dataid = "id="+id;
				//console.log(id);
				$.ajax({
					type: "POST",
					url: "./Ajax_Requests/ProduceDish.php",
					data: dataid,
					cache: false,
					success: function(data){
						window.location.href =  window.location.href;
					}
				})
            });

			$(".finishButton").click(function(){
                var id = $(this).closest('tr').find(".orderId").val();

				dataid = "id="+id;
				//console.log(id);
				$.ajax({
					type: "POST",
					url: "./Ajax_Requests/FinishDish.php",
					data: dataid,
					cache: false,
					success: function(data){
						window.location.href =  window.location.href;
					}
				})
            });

			$(".cancelButton").click(function(){
                var id = $(this).closest('tr').find(".orderId").val();

				dataid = "id="+id;
				//console.log(id);
				$.ajax({
					type: "POST",
					url: "./Ajax_Requests/CancelDish.php",
					data: dataid,
					cache: false,
					success: function(data){
						window.location.href =  window.location.href;
					}
				})
            });
        });
    </script>
</body>
</html>