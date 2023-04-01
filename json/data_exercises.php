<?php

$page = 1;
if(!empty($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    if(false === $page) {
        $page = 1;
    }
}

$limit = 10;
if(!empty($_GET['limit'])) {
    $limit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT);
}

$offset = ($page - 1) * $limit;

header('Content-Type: application/json');
header("access-control-allow-origin: *");

require './app_core.php';

	$sqlQuery = "SELECT * FROM exercises WHERE exercise_status = 1";

	if(getParamsID()){

		$sqlQuery .= " AND exercise_id = '".getParamsID()."'";
	}

	if(getParamsEquipment()){

		$sqlQuery .= " AND JSON_CONTAINS(exercise_equipments, '\"".getParamsEquipment()."\"')";
	}

	if(getParamsLevel()){

		$sqlQuery .= " AND JSON_CONTAINS(exercise_levels, '\"".getParamsLevel()."\"')";
	}

	if(getParamsMuscle()){

		$sqlQuery .= " AND JSON_CONTAINS(exercise_bodyparts, '\"".getParamsMuscle()."\"')";
	}

	if(getParamsAvailability()){

        $sqlQuery .= " AND exercise_availability = '".getParamsAvailability()."'";
	}

    $sqlQuery .= " ORDER BY exercise_id DESC";

    if(isset($_GET['page']) && !empty($_GET['page'])) {
        $sqlQuery .= " LIMIT ".$offset.",".$limit;
    }

    if(isset($_GET['limit']) && !empty($_GET['limit']) && !isset($_GET['page'])) {
        $sqlQuery .= " LIMIT ".$limit;
    }
    
    $sentence = $connect->prepare($sqlQuery);

    $sentence->execute();

    $qResults = $sentence->fetchAll(PDO::FETCH_ASSOC);

	$data = array();

	foreach ($qResults as $row) {

		$id = $row['exercise_id'];
		$title = $row['exercise_title'];
		$description = $row['exercise_description'];
		$image = $row['exercise_image'];
		$reps = $row['exercise_reps'];
		$rest = $row['exercise_rest'];
		$sets = $row['exercise_sets'];
		$time = $row['exercise_time'];
		$type = $row['exercise_type'];
		$instructions = $row['exercise_instructions'];
		$video = $row['exercise_video'];
		$bodyparts = getBodypartsById($row['exercise_bodyparts']);
		$levels = getLevelsById($row['exercise_levels']);
		$equipments = getEquipmentsById($row['exercise_equipments']);
		$availability = $row['exercise_availability'];

		$data[] = array(
			'id'=> $id,
			'title'=> html_entity_decode($title),
			'description'=> html_entity_decode($description),
			'image'=> getImage($image),
			'reps'=> $reps,
			'rest'=> $rest,
			'sets'=> $sets,
			'time'=> $time,
			'type'=> $type,
			'instructions'=> json_decode($instructions),
			'video'=> html_entity_decode($video),
			'availability'=> html_entity_decode($availability),
			'bodyparts'=> $bodyparts,
			'levels'=> $levels,
			'equipments'=> $equipments
		);
	}

	print json_encode($data, JSON_NUMERIC_CHECK);

?>