<?php
	require_once("Includes/config.php");
	require_once("Includes/functions.php");

	// Models
	require_once("Uzsakymai/Models/Patiekalas.php");
	require_once("Uzsakymai/Models/Uzsakymo_patiekalas.php");
	require_once("Uzsakymai/Models/Patiekalo_tipas.php");
	require_once("Uzsakymai/Models/Staliukas.php");
	require_once("Uzsakymai/Models/Uzsakymas.php");

	// Validation
	require_once("Includes/Validation/ValidationHandler.php");
	require_once("Includes/Validation/Integer.php");
	require_once("Includes/Validation/Between.php");
	require_once("Includes/Validation/Not.php");

	session_start();

	$dbc = connect();

	function getValidator() {
		$handler = new ValidationHandler();

		$handler->addField('patiekalas', true, "Prašome pasirinkti patiekalą");
		$handler->addFieldValidator('patiekalas', new Validator_Integer("Prašome pasirinkti patiekalą"));
		$handler->addFieldValidator('patiekalas', new Validator_Between("Prašome pasirinkti patiekalą", 0));

		$handler->addField('staliukas', true, "Prašome pasirinkti staliuką");
		$handler->addFieldValidator('staliukas', new Validator_not("Prašome pasirinkti staliuką", '-1'));

		//$handler->addField('komentaras', true, "Komentaras turi egzistuoti");

		return $handler;
	}

	// User logged in and with required privileges
	if ( isset($_SESSION['userId']) && 
			($_SESSION['userType'] == WAITER_LEVEL || $_SESSION['userType'] == ADMIN_LEVEL) &&
			isset($_GET['id']) ) {
		$dishes = new Patiekalas($dbc);
		$orderDishes = new Uzsakymo_patiekalas($dbc);

		$dishTypes = new Patiekalo_tipas($dbc);

		$tables = new Staliukas($dbc);
		$orders = new Uzsakymas($dbc);

		$errors = array();
		$values = $_POST;

		$validationHandler = getValidator();

		// Bit of a hack, should probably fix this by not submitting hidden element at all
		unset($values['patiekalas'][0]);
		unset($values['patiekalo_tipas'][0]);
		unset($values['komentaras'][0]);

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			if ( $validationHandler->isValid($values) ) {
				$orders->updateOrder($_GET['id'], $values['staliukas']);

				$orderDishes->insertOrderDishes($_GET['id'], $values['patiekalas'], $values['komentaras']);
			} else {
				$errors = $validationHandler->getErrors();
			}
		}

		$dishList = $dishes->getDishesList();
		$tableList = $tables->getTableList();
		
		$order = $orders->getOrder($_GET['id']);
		$dishTypeList = $dishTypes->getProductTypeList();
		$orderedDishList = $orderDishes->getOrderDishes($_GET['id']);

		include("Uzsakymai/Views/uzsakymu_redagavimo_langas.php");

	} else {
		redirect("mainMenu.php");
	}