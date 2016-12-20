<?php
	require_once("Includes/config.php");
	require_once("Includes/functions.php");
	require_once("Uzsakymai/Models/Patiekalas.php");
	require_once("Uzsakymai/Models/Uzsakymo_patiekalas.php");
	require_once("Uzsakymai/Models/Patiekalo_tipas.php");
	require_once("Uzsakymai/Models/Staliukas.php");
	require_once("Uzsakymai/Models/Uzsakymas.php");

	session_start();

	$dbc = connect();

	function isfloat($f) {
		return ($f == (string)(float)$f);
	}

	function validate_post(&$errors, &$values){
		if ( isset($_POST['patiekalas']) ){
			$values['patiekalas'] = $_POST['patiekalas'];
			// Ignore the first one, it's a hidden one
			unset($values['patiekalas'][0]);
			
			if (count($values['patiekalas']) > 0) {
				foreach($values['patiekalas'] as $key => $produktoId) {
					if ( ctype_digit($produktoId) ) {
						if ( intval($produktoId) < 0 ) {
							$errors['patiekalas'] = 1;
						}
					} else {
						$errors['patiekalas'] = 1;
					}
				}
			}
		}

		if ( isset($_POST['komentaras']) ){
			$values['komentaras'] = $_POST['komentaras'];
			// Ignore the first one, it's a hidden one
			unset($values['komentaras'][0]);
		}

		if ( isset($_POST['staliukas']) ){
			$values['staliukas'] = $_POST['staliukas'];
		} else {
			$errors['staliukas'] = "Prašome pasirinkti staliuką";
		}

		return count($errors) == 0;		
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
		$values = array();

		// Form submit
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//var_dump($_POST);
			//die();

			if ( validate_post($errors, $values) ) {
				//echo "valid";
				$orders->updateOrder($_GET['id'], $values['staliukas']);

				$orderDishes->insertOrderDishes($_GET['id'], $values['patiekalas'], $values['komentaras']);
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