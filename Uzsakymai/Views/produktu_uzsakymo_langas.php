<!DOCTYPE html>
<html>
<head>
	<title>Produktų užsakymas</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./Content/css/bootstrap.min.css">
	<link rel="stylesheet" href="./Content/style.css">
	<script src='./Scripts/js/jquery-2.2.4.min.js' type='text/javascript'></script>
  	<script src='./Scripts/js/bootstrap.min.js' type='text/javascript'></script>
</head>
<body>
	<?php include("Includes/navbar.php")  ?>
	<form class="form-horizontal" method="POST">

		<!-- Select Basic -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="produktas">Produktas</label>
			<div class="col-md-4">
				<select id="produktas" name="produktas" class="form-control">
					<option value="-1">Pasirinkite produktą</option>
					<?php $selectedId = isset($values['produktas']) ? $values['produktas'] : -1; ?>
					<?php foreach($productList as $product) {
						$selected = $selectedId == $product['id'] ? " selected" : "";
						echo '<option value = ' . $product['id'] . $selected . '>' .  htmlspecialchars($product['pavadinimas']) . '</option>';
					} ?>
				</select>
				<?php if ( isset($errors['produktas']) ) {
					echo '<p class="text-danger"> * ' . $errors['produktas'] . '</p>';
				} ?>
			</div>
		</div>

		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="kiekis">Kiekis</label>  
			<div class="col-md-2">
				<input id="kiekis" name="kiekis" type="text" placeholder="kiekis" class="form-control" 
						value="<?php echo isset($values['kiekis']) ? htmlspecialchars($values['kiekis']) : "";?>">
				<?php if ( isset($errors['kiekis']) ) {
					echo '<p class="text-danger"> * ' . $errors['kiekis'] . '</p>';
				} ?>
			</div>
		</div>

		<!-- Textarea -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="komentaras">Komentaras</label>
			<div class="col-md-4">                     
				<textarea class="form-control" id="komentaras" name="komentaras" ><?php
					 echo isset($values['komentaras']) ? htmlspecialchars($values['komentaras']) : "";
				?></textarea>
				<?php if ( isset($errors['komentaras']) ) {
					echo '<p class="text-danger"> * ' . $errors['komentaras'] . '</p>';
				} ?>
			</div>
		</div>

		<div class="col-md-offset-6 col-md-2">
			<button type="submit" class="btn btn-primary pull-right">Kurti produktų užsakymą</button>
		</div>
	</form>
</body>
</html>
