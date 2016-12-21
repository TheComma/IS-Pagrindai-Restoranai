<?php
    require_once("Includes/config.php");
	require_once("Includes/functions.php");
	require_once("Uzsakymai/Models/Patiekalas.php");

	session_start();

    $dbc = connect();

	// User logged in and with required privileges
	if ( isset($_SESSION['userId']) && 
			($_SESSION['userType'] == KITCHEN_LEVEL || $_SESSION['userType'] == ADMIN_LEVEL) ) {
		$dishesList = new Patiekalas($dbc);

		$countPerPage = 5;

    	$page = isset( $_GET['page'] ) ? $_GET['page'] : 1;

		$dishes = $dishesList->getDishesList($page, $countPerPage);
    	$dishesCount = $dishesList->getDishCount();
		$pageCount = ceil($dishesCount/$countPerPage);


		//var_dump($orders);

		include("Uzsakymai/Views/patiekalu_saraso_langas.php");

	} else {
		redirect("mainMenu.php");
	}