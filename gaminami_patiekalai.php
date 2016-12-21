<?php
    require_once("Includes/config.php");
    require_once("Includes/functions.php");
    require_once("Uzsakymai/Models/Uzsakymo_patiekalas.php");

    session_start();
    $dbc = connect();

    // User logged in and with required privileges
	if ( isset($_SESSION['userId']) && 
			$_SESSION['userType'] == KITCHEN_LEVEL ) {
		$orders = new Uzsakymo_patiekalas($dbc);

		$orderList = $orders->getCurrentOrders();

        //var_dump($orderList);

		include("Uzsakymai/Views/gaminamu_patiekalu_langas.php");

	} else {
		redirect("mainMenu.php");
	}