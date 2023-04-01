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

	$sqlQuery = "SELECT posts.*, members.member_name AS author_title FROM posts LEFT JOIN members ON members.member_id = posts.post_author WHERE post_status = 1";

	if(getParamsID()){

		$sqlQuery .= " AND posts.post_id = '".getParamsID()."'";
	}

	if(getParamsTag()){

		$sqlQuery .= " AND JSON_CONTAINS(post_tags , '\"".getParamsTag()."\"')";
	}

	if(getParamsAvailability()){

        $sqlQuery .= " AND posts.post_availability = '".getParamsAvailability()."'";
	}

	if(getParamsQuery()){

        $sqlQuery .= " AND posts.post_title LIKE '%".getParamsQuery()."%'";
	}

    $sqlQuery .= " ORDER BY posts.post_created DESC";

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

		$id = $row['post_id'];
		$title = $row['post_title'];
		$description = $row['post_description'];
		$featured = $row['post_featured'];
		$author_id = $row['post_author'];
		$author_name = $row['author_title'];
		$image = $row['post_image'];
		$tags = getTagsById($row['post_tags']);
		$availability = $row['post_availability'];
		$created = formatDate($row['post_created']);
		$updated = formatDate($row['post_updated']);

		$data[] = array(
			'id'=> $id,
			'title'=> html_entity_decode($title),
			'description'=> html_entity_decode($description),
			'featured'=> html_entity_decode($featured),
			'author_id'=> html_entity_decode($author_id),
			'author_name'=> html_entity_decode($author_name),
			'image'=> getImage($image),
			'tags'=> $tags,
			'availability'=> $availability,
			'created'=> $created,
			'updated'=> $updated
		);
	}

	print json_encode($data, JSON_NUMERIC_CHECK);

?>