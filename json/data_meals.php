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

	$sqlQuery = "SELECT meals.*, trainers.* FROM meals LEFT JOIN trainers ON trainers.trainer_member = meals.meal_trainer WHERE meal_status = 1";

	if(getParamsID()){

		$sqlQuery .= " AND meals.meal_id = '".getParamsID()."'";
	}

	if(getParamsCategory()){

		$sqlQuery .= " AND JSON_CONTAINS(meal_categories , '\"".getParamsCategory()."\"')";

	}

	if(getParamsFeatured()){

		$sqlQuery .= " AND meals.meal_featured = '".getParamsFeatured()."'";
	}

	if(getParamsAvailability()){

        $sqlQuery .= " AND meals.meal_availability = '".getParamsAvailability()."'";
	}

	if(getParamsQuery()){

        $sqlQuery .= " AND meals.meal_title LIKE '%".getParamsQuery()."%'";
	}

	if(getParamsUser()){

        $sqlQuery .= " AND meals.meal_id IN (SELECT meal_id FROM meals_users WHERE meals_users.user_id = '".getParamsUser()."')";
	}

    $sqlQuery .= " ORDER BY meals.meal_id DESC ";

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

		$id = $row['meal_id'];
		$title = $row['meal_title'];
		$description = $row['meal_description'];
		$days = getRecipesByMeal($row['meal_days']);
		$featured = $row['meal_featured'];
		$trainer_id = $row['meal_trainer'];
		$trainer_name = $row['trainer_name'];
		$image = $row['meal_image'];
		$categories = getCategoriesById($row['meal_categories']);
		$availability = $row['meal_availability'];
		$calories = $row['meal_calories'];

		$data[] = array(
			'id'=> $id,
			'title'=> html_entity_decode($title),
			'description'=> html_entity_decode($description),
			'days'=> $days,
			'featured'=> html_entity_decode($featured),
			'trainer_id'=> html_entity_decode($trainer_id),
			'trainer_name'=> html_entity_decode($trainer_name),
			'image'=> getImage($image),
			'categories'=> $categories,
			'availability'=> $availability,
			'calories'=> $calories
		);
	}

	print json_encode($data, JSON_NUMERIC_CHECK);

?>