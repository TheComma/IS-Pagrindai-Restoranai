<?php
	require_once("Includes/config.php");
	require_once("Includes/functions.php");

	// Models
	require_once("Uzsakymai/Models/Patiekalas.php");
	require_once("Uzsakymai/Models/Patiekalo_produktas.php");
	require_once("Uzsakymai/Models/Produktas.php");
	require_once("Uzsakymai/Models/Patiekalo_tipas.php");

	// Validation
	require_once("Includes/Validation/ValidationHandler.php");
	require_once("Includes/Validation/Numeric.php");
	require_once("Includes/Validation/Integer.php");
	require_once("Includes/Validation/Between.php");
	require_once("Includes/Validation/StringLength.php");

	session_start();

	$dbc = connect();

	function getValidator() {
		$handler = new ValidationHandler();

		$handler->addField('produktas', true, "Prašome pasirinkti produktą");
		$handler->addFieldValidator('produktas', new Validator_Integer("Prašome pasirinkti produktą"));
		$handler->addFieldValidator('produktas', new Validator_Between("Prašome pasirinkti produktą", 0));

		$handler->addField('kiekis', true, "Prašome įvesti kiekį");
		$handler->addFieldValidator('kiekis', new Validator_Integer("Kiekis turi būti skaičius"));
		$handler->addFieldValidator('kiekis', new Validator_Between("Kiekis negali būti neigiamas", 0));

		$handler->addField('pavadinimas', true, "Prašome įvesti pavadinimą");
		$handler->addFieldValidator('pavadinimas', new Validator_StringLength("Pavadinimas turi būti bent iš trijų raidžių", 3));

		$handler->addField('kaina', true, "Prašome įvesti kainą");
		$handler->addFieldValidator('kaina', new Validator_Numeric("Kaina turi būti skaičius"));
		$handler->addFieldValidator('kaina', new Validator_Between("Kaina negali būti neigiama", 0));

		$handler->addField('patiekaloTipas', true, "Prašome pasirinkti patiekalo tipą");
		$handler->addFieldValidator('patiekaloTipas', new Validator_Integer("Prašome pasirinkti patiekalo tipą"));
		$handler->addFieldValidator('patiekaloTipas', new Validator_Between("Prašome pasirinkti patiekalo tipą", 0));

		$handler->addField('aktyvus', true, "Klaida, turi būti skaičius");
		$handler->addFieldValidator('aktyvus', new Validator_Integer("Klaida, turi būti skaičius"));
		$handler->addFieldValidator('aktyvus', new Validator_Between("Klaida, turi būti skaičius", 0, 1));

		//$handler->addField('komentaras', true, "Komentaras turi egzistuoti");

		return $handler;
	}

	// User logged in and with required privileges
	if ( isset($_SESSION['userId']) && 
			($_SESSION['userType'] == KITCHEN_LEVEL || $_SESSION['userType'] == ADMIN_LEVEL) ) {
		$dishes = new Patiekalas($dbc);
		$dishProducts = new Patiekalo_produktas($dbc);

		$products = new Produktas($dbc);
		$dishTypes = new Patiekalo_tipas($dbc);

		$errors = array();
		$values = $_POST;

		// Form submit
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$validationHandler = getValidator();

			// Bit of a hack, should probably fix this by not submitting hidden element at all
			unset($values['produktas'][0]);
			unset($values['kiekis'][0]);

			if ( $validationHandler->isValid($values) ) {
				$dishes->newDish($values['patiekaloTipas'], 
									$values['pavadinimas'], 
									$values['kaina'], 
									$values['aktyvus'],
									$values['komentaras']);

				$dishId = $dishes->getLastInsertId();

				$dishProducts->insertDishProducts($dishId, $values['produktas'], $values['kiekis']);
				redirect("patiekalu_sarasas.php");
			}

			$errors = $validationHandler->getErrors();
		}

		$productList = $products->getProductList();
		$dishTypeList = $dishTypes->getProductTypeList();

		//var_dump($values);

		include("Uzsakymai/Views/patiekalu_redagavimo_langas.php");

	} else {
		redirect("mainMenu.php");
	}