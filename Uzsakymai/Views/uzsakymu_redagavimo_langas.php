<!DOCTYPE html>
<html>
<head>
	<title>Patiekalo kūrimas</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./Content/css/bootstrap.min.css">
	<link rel="stylesheet" href="./Content/style.css">
	<script src='./Scripts/js/jquery-2.2.4.min.js' type='text/javascript'></script>
  	<script src='./Scripts/js/bootstrap.min.js' type='text/javascript'></script>
</head>
<body>
	<?php include("Includes/navbar.php")  ?>
	<div class="container-fluid">
		<div class="row-fluid">
			<form class="form-horizontal" method="POST">
				<input hidden disabled id="orderId" value="<?php echo $order[0]['id'] ?>">
				<div class="col-md-12">
					<!-- Select Basic -->
					<div class="form-group">
						<label class="col-md-4 control-label" for="staliukas">Staliukas</label>
						<div class="col-md-4">
							<select id="staliukas" name="staliukas" class="form-control" <?php echo  $order[0]['busena'] != 1 ? "disabled" : ""; ?>>
								<option value="-1">Pasirinkite staliuką</option>
								<?php $selectedId = $order[0]['fk_staliukas']; ?>
								<?php foreach($tableList as $table) {
									$selected = strcmp($selectedId, $table['staliuko_indentifikatorius']) == 0 ? " selected" : "";
									echo '<option value=' . $table['staliuko_indentifikatorius'] . $selected . '>' .  htmlspecialchars($table['staliuko_indentifikatorius']) . '</option>';
								} ?>
							</select>
							<?php if ( isset($errors['staliukas']) ) {
								echo '<p class="text-danger"> * ' . $errors['staliukas'] . '</p>';
							} ?>
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<label for="productTable">Patiekalai</label>
					<button type=button id="addProductBtn" class="btn btn-primary" style="margin-left:20px;" <?php echo  $order[0]['busena'] != 1 ? "disabled" : ""; ?>>
						Pridėti patiekalą
					</button>
					<button type=button id="completeOrderBtn" class="btn btn-primary pull-right" style="margin-right:20px;" <?php echo  $order[0]['busena'] != 1 ? "disabled" : ""; ?>>
						Užbaigti užsakymą
					</button>
					<table style="margin-top:10px;" id="productTable" class="table">
						<tbody>
							<tr class="hidden">
								<td>
									<div class="form-group">
										<div class="col-md-12">
											<select onchange="tipasSelectionChanged(this)" class="form-control patiekaloTipasSelect">
												<option value="-1">Pasirinkite patiekalo tipą</option>
												<?php foreach($dishTypeList as $dish) {
													echo '<option class="categoryId' . $dish['id'] . '" value = ' . $dish['id'] . '>' .  htmlspecialchars($dish['pavadinimas']) . '</option>';
												} ?>
											</select>
										</div>
									</div>
								</td>
								<td>
									<div class="form-group">
										<div class="col-md-12">
											<select name="patiekalas[]" class="form-control patiekalasSelect">
												<option value="-1">Pasirinkite patiekalą</option>
												<?php foreach($dishList as $dish) {
													echo '<option class="categoryId' . $dish['fk_tipas'] . '" value=' . $dish['id'] . '>' .  htmlspecialchars($dish['pavadinimas']) . '</option>';
												} ?>
											</select>
										</div>
									</div>
								</td>
								<td>
									<div class="form-group">
										<div class="col-md-12">
											<textarea style="resize: vertical;" class="form-control" name="komentaras[]" placeholder="komentaras"></textarea>
										</div>
									</div>
								</td>
								<td>
								</td>
							</tr>

							<?php if (count($orderedDishList) > 0) {
								foreach($orderedDishList as $key => $dish) { ?>
									<tr>
										<td>
											<div class="form-group">
												<input hidden class="orderedDishId" value="<?php echo $dish['id']; ?>">
												<div class="col-md-12">
													<label>Būsena:</label><p> <?php echo $dish['busena']; ?></p>
												</div
											</div>
										</td>
										<td>
											<div class="form-group">
												<div class="col-md-12">
													<label>Patiekalas:</label><p> <?php echo $dish['pavadinimas']; ?></p>
												</div
											</div>
										</td>
										<td style="text-wrap: normal;word-wrap: break-word;">
											<div class="form-group">
												<div class="col-md-11 col-md-offset-1">
													<label>Komentaras:</label><p> <?php echo $dish['komentaras']; ?></p>
												</div>
											</div>
										</td>
										<td>
											<?php if ($dish['busena'] == 1) { ?>
												<div class="col-md-8 col-md-offset-1">
													<button onclick="SomeDeleteRowFunction(this)" class="btn btn-warning" type="button">Atšaukti</button>
												</div>
											<?php } ?>
										</td>
									</tr>
								<?php  } ?>
							<?php } ?>

						</tbody>
					</table>
				</div>
				<div <?php echo  $order[0]['busena'] != 1 ? "hidden" : ""; ?> class="col-md-11 submitDiv">
					<button class="btn btn-primary pull-right saveButton" type="submit">Saugoti</button></div>
				</div>
			</form>
		</div>
	</div>

	<script>
		var allOptions;
        $(document).ready(function(){
            $("#addProductBtn").click(function(){
				$('#productTable tbody .hidden')
					.clone()
					.removeClass('hidden')
					.appendTo('#productTable tbody');
            });

			$("#completeOrderBtn").click(function(){
				var id = $("#orderId").val();

				dataid = "id="+id;
				//console.log(id);
				$.ajax({
					type: "POST",
					url: "./Ajax_Requests/CompleteOrder.php",
					data: dataid,
					cache: false,
					success: function(data){
						//console.log(data);
						window.location.href =  window.location.href;
					}
				});
			});

			allOptions = $('#productTable tbody .hidden .patiekalasSelect option')
		});

		function SomeDeleteRowFunction(o){
			var id = $(o).closest('tr').find(".orderedDishId").val();

			dataid = "id="+id;
			//console.log(id);
			$.ajax({
				type: "POST",
				url: "./Ajax_Requests/CancelOrderDish.php",
				data: dataid,
				cache: false,
				success: function(data){
					 window.location.href =  window.location.href;
				}
			})
		}

		function tipasSelectionChanged(o) {
				$(o).closest('tr').find('.patiekalasSelect option').remove()
				var classN = $(o).find('option:selected').prop('class');
				var opts = allOptions.filter('.' + classN);
				var x = $(o).closest('tr').find('.patiekalasSelect')
				$.each(opts, function (i, j) {
					$(j).appendTo(x);
				});
		}

		

    </script>

</body>
</html>
