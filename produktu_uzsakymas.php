<?php
    require_once("Includes/config.php");
	require_once("Includes/functions.php");
	require_once("Uzsakymai/Models/Produktu_uzsakymas.php");
	require_once("Uzsakymai/Models/Produktas.php");

	session_start();

    $dbc = connect();

	function isfloat($f) {
		return ($f == (string)(float)$f);
	}

	function validate_post(&$errors, &$values){
		if ( isset($_POST['produktas']) ){
			$values['produktas'] = $_POST['produktas'];

			if (ctype_digit($_POST['produktas'])) {
				if (intval([$_POST['produktas']]) < 0 ) {
					$errors['produktas'] = "Prašome pasirinkti produktą";
				}
			} else {
				$errors['produktas'] = "Prašome pasirinkti produktą";
			}
		} else {
			$errors['produktas'] = "Prašome pasirinkti produktą";
		}

		if ( isset($_POST['kiekis']) && !empty(($_POST['kiekis'])) ){
			$values['kiekis'] = $_POST['kiekis'];

			if ( isfloat($_POST['kiekis']) ) {
				if (floatval([$_POST['kiekis']]) < 0 ) {
					$errors['kiekis'] = "Kiekis negali būti neigiamas";
				}
			} else {
				$errors['kiekis'] = "Kiekis turi būti skaičius";
			}
		} else {
			$errors['kiekis'] = "Prašome įvesti kiekį";
		}

		if ( isset($_POST['komentaras']) ){
			$values['komentaras'] = $_POST['komentaras'];
		}

		return (count($errors)  == 0);		
	}

	// User logged in and with required privileges
	if ( isset($_SESSION['userId']) && 
			$_SESSION['userType'] == KITCHEN_LEVEL ) {
		$productOrder = new Produktu_uzsakymas($dbc);

		$errors = array();
		$values = array();

		// Form submit
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			if ( validate_post($errors, $values) ) {
				$productOrder->newOrder($values['produktas'], $values['kiekis'], $values['komentaras']);
				redirect("uzsakytu_produktu_sarasas.php");
			}
		}

		$products = new Produktas($dbc);

		

		$productList = $products->getProductList();

		//var_dump($productList);

		include("Uzsakymai/Views/produktu_uzsakymo_langas.php");

	} else {
		redirect("mainMenu.php");
	}