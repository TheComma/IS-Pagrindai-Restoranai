<?php
	require_once("Includes/config.php");
	require_once("Includes/functions.php");
	require_once("Uzsakymai/Models/Patiekalas.php");
	require_once("Uzsakymai/Models/Patiekalo_produktas.php");
	require_once("Uzsakymai/Models/Produktas.php");
	require_once("Uzsakymai/Models/Patiekalo_tipas.php");

	session_start();

	$dbc = connect();

	function isfloat($f) {
		return ($f == (string)(float)$f);
	}

	function validate_post(&$errors, &$values){
		if ( isset($_POST['produktas']) ){
			$values['produktas'] = $_POST['produktas'];
			// Ignore the first one, it's a hidden one
			unset($values['produktas'][0]);
			
			if (count($values['produktas']) > 0) {
				foreach($values['produktas'] as $key => $produktoId) {
					if (ctype_digit($produktoId)) {
						if (intval($produktoId) < 0 ) {
							$errors['produktas'][$key] = "Prašome pasirinkti produktą";
						}
					} else {
						$errors['produktas'][$key] = "Prašome pasirinkti produktą";
					}
				}
			}
		}

		if ( isset($_POST['kiekis']) ){
			$values['kiekis'] = $_POST['kiekis'];
			// Ignore the first one, it's a hidden one
			unset($values['kiekis'][0]);
			
			if (count($values['kiekis']) > 0) {
				foreach($values['kiekis'] as $key => $kiekis) {
					if (!empty($kiekis)) {
						if ( isfloat($kiekis) ) {
							if (floatval([$_POST['kiekis']]) < 0 ) {
								$errors['kiekis'][$key] = "Kiekis negali būti neigiamas";
							}
						} else {
							$errors['kiekis'][$key] = "Kiekis turi būti skaičius";
						}
					} else {
						$errors['kiekis'][$key] = "Prašome įvesti kiekį";
					}
				}
			}
		}

		if ( isset($_POST['komentaras']) ){
			$values['komentaras'] = $_POST['komentaras'];
		} else {
			$values['komentaras'] = "";
		}

		if ( isset($_POST['pavadinimas']) ){
			$values['pavadinimas'] = $_POST['pavadinimas'];

			if (mb_strlen($values['pavadinimas']) < 1) {
				$errors['pavadinimas'] = "Prašome įvesti pavadinimą";
			}
		}

		if ( isset($_POST['kaina']) && mb_strlen(($_POST['kaina']) > 0) ){
			$values['kaina'] = $_POST['kaina'];

			if ( isfloat($values['kaina']) ) {
				if (floatval($values['kaina']) < 0 ) {
					$errors['kaina'] = "Kaina negali būti neigiama";
				}
			} else {
				$errors['kaina'] = "Kaina turi būti skaičius";
			}
		} else {
			$errors['kaina'] = "Prašome įvesti kainą";
		}

		if ( isset($_POST['patiekaloTipas']) && 
				ctype_digit($_POST['patiekaloTipas']) && 
				intval($_POST['patiekaloTipas']) >= 0) {
			$values['patiekaloTipas'] = $_POST['patiekaloTipas'];
		} else {
			$errors['patiekaloTipas'] = "Prašome pasirinkti patiekalo tipą";
		}

		if ( isset($_POST['aktyvus']) ){
			$values['aktyvus'] = $_POST['aktyvus'];

			$aktyvus = intval($values['aktyvus']);

			if ($aktyvus !== 1 && $aktyvus !== 0){
				$errors['aktyvus'] = "Klaida, turi būti skaičius";
			}
		}

		return (count($errors)  == 0);		
	}

	// User logged in and with required privileges
	if ( isset($_SESSION['userId']) && 
			($_SESSION['userType'] == WAITER_LEVEL || $_SESSION['userType'] == ADMIN_LEVEL) ) {
		$dishes = new Patiekalas($dbc);
		$dishProducts = new Patiekalo_produktas($dbc);

		$products = new Produktas($dbc);
		$dishTypes = new Patiekalo_tipas($dbc);

		$errors = array();
		$values = array();
		$values['produktas'] = array();

		// Form submit
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			var_dump($_POST);
			//die();

			if ( validate_post($errors, $values) ) {
				$dishes->newDish($values['patiekaloTipas'], 
									$values['pavadinimas'], 
									$values['kaina'], 
									$values['aktyvus'],
									$values['komentaras']);
				$dishId = $dishes->getLastInsertId();

				var_dump($dishId);

				$dishProducts->insertDishProducts($dishId, $values['produktas'], $values['kiekis']);
				//redirect("uzsakytu_produktu_sarasas.php");
				//die();
			}
		}

		$productList = $products->getProductList();
		$dishTypeList = $dishTypes->getProductTypeList();

		//var_dump($productList);

		include("Uzsakymai/Views/patiekalu_redagavimo_langas.php");

	} else {
		redirect("mainMenu.php");
	}