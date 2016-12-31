<?php
	require_once("Includes/config.php");
	require_once("Includes/functions.php");

	//Models
	require_once("Uzsakymai/Models/Produktu_uzsakymas.php");
	require_once("Uzsakymai/Models/Produktas.php");

	//Validation
	require_once("Includes/Validation/ValidationHandler.php");
	require_once("Includes/Validation/Numeric.php");
	require_once("Includes/Validation/Between.php");

	session_start();

	$dbc = connect();

	function getValidator() {
		$handler = new ValidationHandler();

		$handler->addField('produktas', true, "Prašome pasirinkti produktą");
		$handler->addFieldValidator('produktas', new Validator_Numeric("Prašome pasirinkti produktą"));
		$handler->addFieldValidator('produktas', new Validator_Between("Prašome pasirinkti produktą", 0));

		$handler->addField('kiekis', true, "Prašome įvesti kiekį");
		$handler->addFieldValidator('kiekis', new Validator_Numeric("Kiekis turi būti skaičius"));
		$handler->addFieldValidator('kiekis', new Validator_Between("Kiekis negali būti neigiamas", 0));

		//$handler->addField('komentaras', true, "Komentaras turi egzistuoti");

		return $handler;
	}

	// User logged in and with required privileges
	if ( isset($_SESSION['userId']) && 
			$_SESSION['userType'] == KITCHEN_LEVEL ) {
		$productOrder = new Produktu_uzsakymas($dbc);

		$errors = array();
		$values = $_POST;

		// Form submit
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$validationHandler = getValidator();
			$validationHandler->setParams($values);

			if ( $validationHandler->isValid() ) {
				$productOrder->newOrder($values['produktas'], $values['kiekis'], $values['komentaras']);
				redirect("uzsakytu_produktu_sarasas.php");
			}

			$errors = $validationHandler->getErrors();
			//var_dump($errors);
		}

		$products = new Produktas($dbc);

		

		$productList = $products->getProductList();

		//var_dump($productList);

		include("Uzsakymai/Views/produktu_uzsakymo_langas.php");

	} else {
		redirect("mainMenu.php");
	}