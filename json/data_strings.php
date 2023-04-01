<?php

header('Content-Type: application/json');
header("access-control-allow-origin: *");

require './app_core.php';

	$sqlQuery = "SELECT * FROM settings";

	$sentence = $connect->prepare($sqlQuery);

	$sentence->execute();

	$qResults = $sentence->fetchAll(PDO::FETCH_ASSOC);

	$data = array();

	foreach ($qResults as $row) {

		$st_aboutus = $row['st_aboutus'];
		$st_privacypolicy = $row['st_privacypolicy'];
		$st_termsofservice = $row['st_termsofservice'];

		$data[] = array(
			'st_aboutus'=> $st_aboutus,
			'st_privacypolicy'=> $st_privacypolicy,
			'st_termsofservice'=> $st_termsofservice
		);
	}

	print json_encode($data, JSON_NUMERIC_CHECK);

?>