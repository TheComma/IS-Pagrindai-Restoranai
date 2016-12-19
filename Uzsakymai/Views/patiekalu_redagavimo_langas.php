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
				<div class="col-md-5">
					<!-- Select Basic -->
					<div class="form-group">
						<label class="col-md-3 control-label" for="patiekaloTipas">Patiekalo  tipas</label>
						<div class="col-md-9">
							<select id="patiekaloTipas" name="patiekaloTipas" class="form-control">
								<option value="-1">Pasirinkite patiekalo tipą</option>
								<?php $selectedId = isset($values['patiekaloTipas']) ? $values['patiekaloTipas'] : -1; ?>
								<?php foreach($dishTypeList as $dishType) {
									$selected = $selectedId == $dishType['id'] ? " selected" : "";
									echo '<option value = ' . $dishType['id'] . $selected . '>' .  htmlspecialchars($dishType['pavadinimas']) . '</option>';
								} ?>
							</select>
							<?php if ( isset($errors['patiekaloTipas']) ) {
								echo '<p class="text-danger"> * ' . $errors['patiekaloTipas'] . '</p>';
							} ?>
						</div>
					</div>

					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-3 control-label" for="pavadinimas">Pavadinimas</label>  
						<div class="col-md-9">
							<input id="pavadinimas" name="pavadinimas" type="text" placeholder="pavadinimas" class="form-control" 
									value="<?php echo isset($values['pavadinimas']) ? htmlspecialchars($values['pavadinimas']) : "";?>">
							<?php if ( isset($errors['pavadinimas']) ) {
								echo '<p class="text-danger"> * ' . $errors['pavadinimas'] . '</p>';
							} ?>
						</div>
					</div>

					<!-- Textarea -->
					<div class="form-group">
						<label class="col-md-3 control-label" for="kaina">Kaina</label>
						<div class="col-md-9">                     
							<input id="kaina" name="kaina" type="text" placeholder="kaina" class="form-control" 
									value="<?php echo isset($values['kaina']) ? htmlspecialchars($values['kaina']) : "";?>">
							<?php if ( isset($errors['kaina']) ) {
								echo '<p class="text-danger"> * ' . $errors['kaina'] . '</p>';
							} ?>
						</div>
					</div>

					<!-- Select Basic -->
					<div class="form-group">
						<label class="col-md-3 control-label" for="aktyvus">Ar aktyvus</label>
						<div class="col-md-9">
							<select id="aktyvus" name="aktyvus" class="form-control">
								<?php $selectedId = isset($values['aktyvus']) ? $values['aktyvus'] : 1; ?>
								<option value="0" <?php echo $selectedid = 0 ? "selected" : "";?> >Neaktyvus</option>;
								<option value="1" <?php echo $selectedid = 1 ? "selected" : "";?> >Aktyvus</option>;
							</select>
							<?php if ( isset($errors['aktyvus']) ) {
								echo '<p class="text-danger"> * ' . $errors['aktyvus'] . '</p>';
							} ?>
						</div>
					</div>

					<!-- Textarea -->
					<div class="form-group">
						<label class="col-md-3 control-label" for="komentaras">Komentaras</label>
						<div class="col-md-9">                     
							<textarea class="form-control" id="komentaras" name="komentaras" ><?php
								echo isset($values['komentaras']) ? htmlspecialchars($values['komentaras']) : "";
							?></textarea>
							<?php if ( isset($errors['komentaras']) ) {
								echo '<p class="text-danger"> * ' . $errors['komentaras'] . '</p>';
							} ?>
						</div>
					</div>

					<div class="col-md-offset-10 col-md-2">
						<button type="submit" class="btn btn-primary pull-right">Kurti patiekalą</button>
					</div>
				</div>

				<div class="col-md-7">
					<label for="productTable">Produktai</label>
					<button type=button id="addProductBtn" class="btn btn-primary" style="margin-left:20px;">Pridėti produktą</button>
					<table style="margin-top:10px;" id="productTable" class="table">
						<tbody>
							<tr class="hidden">
								<td>
									<div class="form-group">
										<div class="col-md-12">
											<select name="produktas[]" class="form-control">
												<option value="-1">Pasirinkite produktą</option>
												<?php foreach($productList as $product) {
													echo '<option value = ' . $product['id'] . '>' .  htmlspecialchars($product['pavadinimas']) . '</option>';
												} ?>
											</select>
										</div
									</div>
								</td>
								<td>
									<div class="form-group">
										<div class="col-md-11 col-md-offset-1">
											<input  name="kiekis[]" type="text" placeholder="kiekis" class="form-control" >
										</div>
									</div>
								</td>
								<td>
									<div class="col-md-8 col-md-offset-1">
										<button onclick="SomeDeleteRowFunction(this)" class="btn btn-warning removeButton" type="button">Pašalinti</button>
									</div>
								</td>
							</tr>

							<?php foreach($values['produktas'] as $key => $produktoId) { ?>
								<tr>
									<td>
										<div class="form-group">
											<div class="col-md-12">
												<select name="produktas[]" class="form-control">
													<option value="-1">Pasirinkite produktą</option>
													<?php foreach($productList as $product) {
														$selected = $product['id'] == $produktoId ? " selected" : "";
														echo '<option value = ' . $product['id'] . $selected . '>' .  htmlspecialchars($product['pavadinimas']) . '</option>';
													} ?>
												</select>
												<?php if ( isset($errors['produktas'][$key]) ) {
													echo '<p class="text-danger"> * ' . $errors['produktas'][$key] . '</p>';
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
    </script>

</body>
</html>
