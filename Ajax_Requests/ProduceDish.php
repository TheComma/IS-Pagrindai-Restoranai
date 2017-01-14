<?php
	require_once("../Includes/functions.php");
	require_once("../Uzsakymai/Models/Uzsakymo_patiekalas.php");

	$dbc = connect();

	if ( isset($_POST['id']) ) {
		$orderDishes = new Uzsakymo_patiekalas($dbc);

		$orderDishes->pakeisti_busena($_POST['id'], 2);
	}