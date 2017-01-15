<?php
	function isrinkti_patiekalus($conn){
		$query = "  SELECT patiekalas.*
					FROM patiekalas
					ORDER BY id";

		$result = mysqli_query($conn, $query);

		if (!$result || (mysqli_num_rows($result) < 1)) {
			return NULL;
		}

		$dbarray = array();
		while ($product = mysqli_fetch_assoc($result)){
			$dbarray[] = $product;
		}

		return $dbarray;
	}

	function irasyti($conn, $data, $padavejas, $patiekalas, $kiekis){
		$query = "  INSERT INTO padavejo_maistas (data, kiekis, fk_padavejas, fk_patiekalas) 
					VALUES('$data', $kiekis, $padavejas, $patiekalas)";

		return mysqli_query($conn, $query);
	}

	session_start();

	if(!isset($_SESSION["userType"]) || !isset($_SESSION["userId"])){
    	header('Location: ./index.php');
    }

	if ( !isset($_GET['data']) ) {
		header('Location: suvartotu_produktu_apskaita.php');
		die();
	} else if ( empty($_GET['data']) ) {
		header('Location: suvartotu_produktu_apskaita.php');
		die();
	}

	$conn = mysqli_connect('localhost', 'root', '','restoranai-db');

	if( !$conn ){
		die('Negaliu prisijungti: ' . mysqli_connect_errno($conn) . ' : ' . mysqli_connect_error($conn));
	}

	mysqli_set_charset($conn, "utf8");

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Hack because of submitting hidden values
		unset($_POST['patiekalas'][0]);
		unset($_POST['kiekis'][0]);

		//var_dump($_POST);

		foreach ($_POST['patiekalas'] as $key => $patiekalas) {
			irasyti($conn, $_GET['data'], $_SESSION["userRefId"], $patiekalas, $_POST['kiekis'][$key]);
		}

		header("Location: suvartotu_produktu_apskaita.php");
        die();
	}

	$productList = isrinkti_patiekalus($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Suvartotų patiekalų fiksavimas</title>
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
			<form class="form-horizontal" method="POST">
				<div class="row">
					<h4>Suvartotų patiekalų fiksavimas, data: <?php echo $_GET['data']?></h4>
				</div>
				<div class="row">
				<label for="productTable">Patiekalai</label>
				<button type=button id="addProductBtn" class="btn btn-primary" style="margin-left:20px;">Pridėti patiekalą</button>
				<table style="margin-top:10px;" id="productTable" class="table">
					<tbody>
						<tr class="hidden">
							<td>
								<div class="form-group">
									<div class="col-md-12">
										<select name="patiekalas[]" class="form-control">
											<option value="-1">Pasirinkite patiekalą</option>
											<?php foreach($productList as $product) {
												echo '<option value = ' . $product['id'] . '>' .  htmlspecialchars($product['pavadinimas']) . '</option>';
											} ?>
										</select>
									</div>
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
								<div class="col-md-12 col-md-offset-1">
									<button onclick="SomeDeleteRowFunction(this)" class="btn btn-warning removeButton" type="button">Pašalinti</button>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<input type="text" name="data" value="<?php echo $_GET['data']?>" hidden />
				<button type="submit" class="btn btn-primary pull-right" >
					Saugoti
				</button>
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
