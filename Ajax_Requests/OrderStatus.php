<?php
	require_once("../Includes/functions.php");
	require_once("../Uzsakymai/Models/Produktu_uzsakymas.php");

	$dbc = connect();

	if ( isset($_POST['id']) && isset($_POST['status'])) {
		$orders = new Produktu_uzsakymas($dbc);

		$orders->setOrderState($_POST['id'], $_POST['status']);
	}