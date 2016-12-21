<!DOCTYPE html>
<html>
<head>
	<title>Užsakymo kūrimas</title>
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
		<div class="col-md-offset-4 col-md-4">
			<button type="submit" class="btn btn-primary pull-right">Kurti užsakymą</button>
		</div>
	</form>
</body>
</html>
