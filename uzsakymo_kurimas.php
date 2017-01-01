<?php
	require_once("Includes/config.php");
	require_once("Includes/functions.php");

	// Models
	require_once("Uzsakymai/Models/Staliukas.php");
	require_once("Uzsakymai/Models/Uzsakymas.php");

	session_start();

	$dbc = connect();

	function validate_post(&$errors, $values){
		if (intval($values['staliukas']) == -1) {
			$errors['staliukas'] = "Prašome pasirinkti staliuką";
		}

		return count($errors) == 0;
	}

	// User logged in and with required privileges
	if ( isset($_SESSION['userId']) && 
			($_SESSION['userType'] == WAITER_LEVEL || $_SESSION['userType'] == ADMIN_LEVEL) ) {
		$tables = new Staliukas($dbc);
		$orders = new Uzsakymas($dbc);

		$errors = array();
		$values = $_POST;

		var_dump($values);

		// Form submit
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			if ( validate_post($errors, $values) ) {
				$orders->newOrder($values['staliukas']);

				$orderId = $orders->getLastInsertId();

				redirect("uzsakymo_redagavimas.php?id=" . $orderId);
			}
		}
		
		$tableList = $tables->getTableList();

		//var_dump($tableList);

		include("Uzsakymai/Views/uzsakymu_kurimo_langas.php");

	} else {
		redirect("mainMenu.php");
	}