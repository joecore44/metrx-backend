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

	$sqlQuery = "SELECT products.*, members.member_name AS author_name FROM products LEFT JOIN members ON members.member_id = products.product_author WHERE product_status = 1";

	if(getParamsID()){

		$sqlQuery .= " AND products.product_id = '".getParamsID()."'";
	}

	if(getParamsTag()){

		$sqlQuery .= " AND JSON_CONTAINS(product_tags , '\"".getParamsTag()."\"')";

	}

	if(getParamsAvailability()){

        $sqlQuery .= " AND products.product_availability = '".getParamsAvailability()."'";
	}

	if(getParamsQuery()){

        $sqlQuery .= " AND products.product_title LIKE '%".getParamsQuery()."%'";
	}

    $sqlQuery .= " ORDER BY products.product_id DESC ";

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

		$id = $row['product_id'];
		$title = $row['product_title'];
		$description = $row['product_description'];
		$featured = $row['product_featured'];
		$price = $row['product_price'];
		$old_price = $row['product_old_price'];
		$link = $row['product_link'];
		$author_id = $row['product_author'];
		$author_name = $row['author_name'];
		$image = $row['product_image'];
		$tags = getProductTagsById($row['product_tags']);
		$gallery = getProductGalleryById($row['product_id']);
		$availability = $row['product_availability'];

		$data[] = array(
			'id'=> $id,
			'title'=> html_entity_decode($title),
			'description'=> html_entity_decode($description),
			'featured'=> html_entity_decode($featured),
			'author_id'=> html_entity_decode($author_id),
			'price'=> html_entity_decode($price),
			'old_price'=> html_entity_decode($old_price),
			'link'=> html_entity_decode($link),
			'author_name'=> html_entity_decode($author_name),
			'image'=> getImage($image),
			'tags'=> $tags,
			'gallery'=> $gallery,
			'availability'=> $availability
		);
	}

	print json_encode($data, JSON_NUMERIC_CHECK);

?>