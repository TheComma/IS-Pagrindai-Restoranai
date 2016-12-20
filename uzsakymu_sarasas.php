<?php
    require_once("Includes/config.php");
	require_once("Includes/functions.php");
	require_once("Uzsakymai/Models/Uzsakymas.php");

	session_start();

    $dbc = connect();

	// User logged in and with required privileges
	if ( isset($_SESSION['userId']) && 
			($_SESSION['userType'] == WAITER_LEVEL || $_SESSION['userType'] == ADMIN_LEVEL) ) {
		$orders = new Uzsakymas($dbc);

		$countPerPage = 10;

    	$page = isset( $_GET['page'] ) ? $_GET['page'] : 1;

		$orderList = $orders->getOrders($page, $countPerPage);
    	$orderCount = $orders->getOrderCount();
		$pageCount = ceil($orderCount/$countPerPage);


		//var_dump($orders);

		include("Uzsakymai/Views/uzsakymu_saraso_langas.php");

	} else {
		redirect("mainMenu.php");
	}