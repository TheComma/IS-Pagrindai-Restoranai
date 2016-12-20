<?php
	require_once("../Includes/functions.php");
	require_once("../Uzsakymai/Models/Uzsakymo_patiekalas.php");
	require_once("../Uzsakymai/Models/Uzsakymas.php");

	$dbc = connect();

	if ( isset($_POST['id']) ) {
		$order = new Uzsakymas($dbc);
		$orderDishes = new Uzsakymo_patiekalas($dbc);

		$order->completeOrder($_POST['id']);
		$orderDishes->cancelDishes($_POST['id']);
	}