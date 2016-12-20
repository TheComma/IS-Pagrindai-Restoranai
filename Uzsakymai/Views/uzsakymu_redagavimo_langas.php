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
				<div class="col-md-12">
					<!-- Select Basic -->
					<div class="form-group">
						<label class="col-md-4 control-label" for="staliukas">Staliukas</label>
						<div class="col-md-4">
							<select id="staliukas" name="staliukas" class="form-control">
								<option value="-1">Pasirinkite staliuką</option>
								<?php $selectedId = isset($values['staliukas']) ? $values['staliukas'] : -1; ?>
								<?php foreach($tableList as $table) {
									$selected = $selectedId == $table['staliuko_indentifikatorius'] ? " selected" : "";
									echo '<option value = ' . $table['staliuko_indentifikatorius'] . $selected . '>' .  htmlspecialchars($table['staliuko_indentifikatorius']) . '</option>';
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
					<button type=button id="addProductBtn" class="btn btn-primary" style="margin-left:20px;">Pridėti patiekalą</button>
					<table style="margin-top:10px;" id="productTable" class="table">
						<tbody>
							<tr class="hidden">
								<td>
									<div class="form-group">
										<div class="col-md-12">
											<select onchange="tipasSelectionChanged(this)" name="patiekaloTipas[]" class="form-control patiekaloTipasSelect">
												<option value="-1">Pasirinkite patiekalo tipą</option>
												<?php foreach($dishTypeList as $dish) {
													echo '<option value = ' . $dish['id'] . '>' .  htmlspecialchars($dish['pavadinimas']) . '</option>';
												} ?>
											</select>
										</div
									</div>
								</td>
								<td>
									<div class="form-group">
										<div class="col-md-12">
											<select name="patiekalas[]" class="form-control patiekalasSelect" disabled>
												<option value="-1">Pasirinkite patiekalą</option>
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
									<div class="col-md-8 col-md-offset-1">
										<button onclick="SomeDeleteRowFunction(this)" class="btn btn-warning removeButton" type="button">Pašalinti</button>
									</div>
								</td>
							</tr>

							<?php foreach($values['patiekalas'] as $key => $dishId) { ?>
								<tr>
									<td>
										<div class="form-group">
											<div class="col-md-12">
												<select onchange="tipasSelectionChanged(this)" name="patiekaloTipas[]" class="form-control">
													<option value="-1">Pasirinkite produkto tipą</option>
													<?php $selectedId = $values['patiekaloTipas'][$key]; ?>
													<?php foreach($dishTypeList as $dish) {
														$selected = $dish['id'] == $selectedId ? " selected" : "";
														echo '<option value = ' . $dish['id'] . $selected . '>' .  htmlspecialchars($dish['pavadinimas']) . '</option>';
													} ?>
												</select>
												<?php if ( isset($errors['patiekaloTipas'][$key]) ) {
													echo '<p class="text-danger"> * ' . $errors['patiekaloTipas'][$key] . '</p>';
												} ?>
											</div
										</div>
									</td>
									<td>
										<?php $typePicked = isset($errors['patiekaloTipas'][$key]) ? false : true; ?>
										<div class="form-group">
											<div class="col-md-12">
												<select name="patiekalas[]" class="form-control patiekalasSelect" <?php echo $typePicked ? "" : "disabled"; ?>>
													<option value="-1">Pasirinkite patiekalą</option>
													<?php
														if ( $typePicked ) {
															$filteredDishList = array();

															foreach($dishList as $dish) {
																if ($dish['fk_tipas'] == $values['patiekaloTipas'][$key]) {
																	$filteredDishList[] = $dish;
																}
															}

															foreach($filteredDishList as $dish) {
																$selected = $dish['id'] == $produktoId ? " selected" : "";
																echo '<option value = ' . $dish['id'] . $selected . '>' .  htmlspecialchars($dish['pavadinimas']) . '</option>';
															} 
														} 
													?>
														
												</select>
												<?php if ( $typePicked && isset($errors['patiekalas'][$key]) ) {
													echo '<p class="text-danger"> * ' . $errors['patiekalas'][$key] . '</p>';
												} ?>
											</div
										</div>
									</td>
									<td>
										<div class="form-group">
											<div class="col-md-11 col-md-offset-1">
												<input  name="kiekis[]" type="text" placeholder="kiekis" class="form-control" 
													value="<?php echo htmlspecialchars($values['kiekis'][$key]); ?>">
												<?php if ( isset($errors['kiekis'][$key]) ) {
													echo '<p class="text-danger"> * ' . $errors['kiekis'][$key] . '</p>';
												} ?>
											</div>
										</div>
									</td>
									<td>
										<div class="col-md-8 col-md-offset-1">
											<button onclick="SomeDeleteRowFunction(this)" class="btn btn-warning removeButton" type="button">Pašalinti</button>
										</div>
									</td>
								</tr>
							<?php  } ?>

						</tbody>
					</table>
				</div>
				<div class="col-md-11">
					<button class="btn btn-primary pull-right" type="submit">Saugoti</button></div>
				</div>
			</form>
		</div>
	</div>

	<script>
        $(document).ready(function(){
            $("#addProductBtn").click(function(){
				$('#productTable tbody .hidden')
					.clone()
					.removeClass('hidden')
					.appendTo('#productTable tbody');
            });
        });

		function SomeDeleteRowFunction(o){
			var p=o.parentNode.parentNode.parentNode;
         	p.parentNode.removeChild(p);
		}

		function tipasSelectionChanged(o) {
			var x = $(o).val();
			if (x >= 0) {
				$(o).closest("tr")
					.find(".patiekalasSelect")
					.prop('disabled', false);
			} else {
				$(o).closest("tr")
					.find(".patiekalasSelect")
					.val(-1);

				$(o).closest("tr")
					.find(".patiekalasSelect")
					.prop('disabled', true);
			}
			
		}
    </script>

</body>
</html>
