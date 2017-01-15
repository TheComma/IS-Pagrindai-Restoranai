<?php
    require_once("Includes/config.php");
	require_once("Includes/functions.php");
	require_once("Uzsakymai/Models/Produktu_uzsakymas.php");

	session_start();

    $dbc = connect();

	// User logged in and with required privileges
	if ( isset($_SESSION['userId']) && 
			($_SESSION['userType'] == KITCHEN_LEVEL || $_SESSION['userType'] == ADMIN_LEVEL) ) {
		$productList = new Produktu_uzsakymas($dbc);

		$countPerPage = 10;

    	$page = isset( $_GET['page'] ) ? $_GET['page'] : 1;

		$orders = $productList->getOrders($page, $countPerPage);
    	$orderCount = $productList->getOrderCount();
		$pageCount = ceil($orderCount/$countPerPage);


		//var_dump($orders);

		include("Uzsakymai/Views/uzsakytu_produktu_saraso_langas.php");

	} else {
		redirect("mainMenu.php");
	}