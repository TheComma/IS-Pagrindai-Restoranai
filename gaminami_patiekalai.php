<?php
    require_once("Includes/config.php");
    require_once("Includes/functions.php");

	// Models
    require_once("Uzsakymai/Models/Uzsakymo_patiekalas.php");

	// Validation
	require_once("Includes/Validation/ValidationHandler.php");
	require_once("Includes/Validation/Integer.php");
	require_once("Includes/Validation/Between.php");

    session_start();
    $dbc = connect();
	
	function getValidator() {
		$handler = new ValidationHandler();

		$handler->addField('busena', true, "Trūksta būsenos");
		$handler->addFieldValidator('busena', new Validator_Integer(""));
		$handler->addFieldValidator('busena', new Validator_Between("", 0, 4));

		$handler->addField('id', true, "Trūksta id");
		$handler->addFieldValidator('id', new Validator_Integer(""));
		$handler->addFieldValidator('id', new Validator_Between("", 0));

		//$handler->addField('komentaras', true, "Komentaras turi egzistuoti");

		return $handler;
	}

    // User logged in and with required privileges
	if ( isset($_SESSION['userId']) && 
			$_SESSION['userType'] == KITCHEN_LEVEL ) {
		$orders = new Uzsakymo_patiekalas($dbc);

		$values = $_POST;

		// Form submit
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$validationHandler = getValidator();

			//var_dump($values);

			if ( $validationHandler->isValid($values) ) {
				$orders->pakeisti_busena($values["id"], $values["busena"]);
			}

			//var_dump($validationHandler->getErrors());
		}

		$orderList = $orders->getCurrentOrders();

        //var_dump($orderList);

		include("Uzsakymai/Views/gaminamu_patiekalu_langas.php");

	} else {
		redirect("mainMenu.php");
	}