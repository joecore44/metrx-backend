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

	$sqlQuery = "SELECT recipes.*, members.member_name AS author_title FROM recipes LEFT JOIN members ON members.member_id = recipes.recipe_author WHERE recipe_status = 1";

	if(getParamsID()){

		$sqlQuery .= " AND recipes.recipe_id = '".getParamsID()."'";
	}

	if(getParamsCategory()){

		$sqlQuery .= " AND JSON_CONTAINS(recipe_categories , '\"".getParamsCategory()."\"')";

	}

	if(getParamsFeatured()){

		$sqlQuery .= " AND recipes.recipe_featured = '".getParamsFeatured()."'";
	}

	if(getParamsAvailability()){

        $sqlQuery .= " AND recipes.recipe_availability = '".getParamsAvailability()."'";
	}

	if(getParamsQuery()){

        $sqlQuery .= " AND recipes.recipe_title LIKE '%".getParamsQuery()."%'";
	}

    $sqlQuery .= " ORDER BY recipes.recipe_id DESC ";

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

		$id = $row['recipe_id'];
		$title = $row['recipe_title'];
		$description = $row['recipe_description'];
		$ingredients = $row['recipe_ingredients'];
		$steps = $row['recipe_steps'];
		$featured = $row['recipe_featured'];
		$author_id = $row['recipe_author'];
		$author_name = $row['author_title'];
		$image = $row['recipe_image'];
		$categories = getCategoriesById($row['recipe_categories']);
		$availability = $row['recipe_availability'];

		$data[] = array(
			'id'=> $id,
			'title'=> html_entity_decode($title),
			'description'=> html_entity_decode($description),
			'ingredients'=> json_decode($ingredients),
			'steps'=> json_decode($steps),
			'featured'=> html_entity_decode($featured),
			'author_id'=> html_entity_decode($author_id),
			'author_name'=> html_entity_decode($author_name),
			'image'=> getImage($image),
			'categories'=> $categories,
			'availability'=> $availability
		);
	}

	print json_encode($data, JSON_NUMERIC_CHECK);

?>