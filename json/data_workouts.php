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

	$sqlQuery = "SELECT workouts.*, trainers.* FROM workouts LEFT JOIN trainers ON trainers.trainer_member = workouts.workout_trainer WHERE workout_status = 1";

	if(getParamsID()){

		$sqlQuery .= " AND workout_id = '".getParamsID()."'";
	}

	if(getParamsEquipment()){

		$sqlQuery .= " AND JSON_CONTAINS(workout_equipments , '\"".getParamsEquipment()."\"')";
	}

	if(getParamsLevel()){

		$sqlQuery .= " AND JSON_CONTAINS(workout_levels , '\"".getParamsLevel()."\"')";
	}

	if(getParamsMuscle()){

		$sqlQuery .= " AND JSON_CONTAINS(workout_bodyparts , '\"".getParamsMuscle()."\"')";
	}

	if(getParamsAvailability()){

        $sqlQuery .= " AND workout_availability = '".getParamsAvailability()."'";
	}

	if(getParamsUser()){

        $sqlQuery .= " AND workouts.workout_id IN (SELECT workout_id FROM workouts_users WHERE workouts_users.user_id = '".getParamsUser()."')";
	}

    $sqlQuery .= " ORDER BY workouts.workout_id DESC";

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

		$id = $row['workout_id'];
		$title = $row['workout_title'];
		$description = $row['workout_description'];
		$image = $row['workout_image'];
		$type = $row['workout_type'];
		$exercises = ($row['workout_type'] == "single" ? getExercisesBySingle($row['workout_exercises']) : getExercisesByWeek($row['workout_exercises']));
		$total_exercises = ($row['workout_type'] == "single" ? getTotalOfExercisesBySingle($row['workout_exercises']) : getTotalOfExercisesByWeek($row['workout_exercises']));
		$bodyparts = getBodypartsById($row['workout_bodyparts']);
		$levels = getLevelsById($row['workout_levels']);
		$trainer_id = $row['workout_trainer'];
		$trainer_name = $row['trainer_name'];
		$goals = getGoalsById($row['workout_goals']);
		$equipments = getEquipmentsById($row['workout_equipments']);
		$availability = $row['workout_availability'];
		$rate = $row['workout_rate'];

		$data[] = array(
			'id'=> $id,
			'title'=> html_entity_decode($title),
			'description'=> html_entity_decode($description),
			'image'=> getImage($image),
			'type'=> $type,
			'exercises'=> $exercises,
			'total_exercises'=> $total_exercises,
			'availability'=> html_entity_decode($availability),
			'trainer_id'=> html_entity_decode($trainer_id),
			'trainer_name'=> html_entity_decode($trainer_name),
			'bodyparts'=> $bodyparts,
			'levels'=> $levels,
			'goals'=> $goals,
			'equipments'=> $equipments,
			'rate'=> $rate
		);
	}

	print json_encode($data, JSON_NUMERIC_CHECK);

?>