<?php 

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require '../config.php';
require '../functions.php';

$errors = array();

if(check_session() == true){   

if(check_permission('create_recipes')){

$memberInfo = get_member_information();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$recipe_title = cleardata($_POST['recipe_title']);
	$recipe_description = cleardata($_POST['recipe_description']);
	$recipe_status = cleardata($_POST['recipe_status']);
	$recipe_availability = cleardata($_POST['recipe_availability']);
	$recipe_ingredients = cleardata($_POST['recipe_ingredients']);
	$recipe_steps = cleardata($_POST['recipe_steps']);
	$recipe_categories = (isset($_POST['recipe_categories']) && !empty($_POST['recipe_categories']) ? json_encode($_POST['recipe_categories']) : "");

	$required_fields = ['recipe_title'];
	foreach($required_fields as $field) {
		if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
				$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
		}
	}
	
	$image = ['recipe_image' => isset($_FILES['recipe_image']['name']) && !empty($_FILES['recipe_image']['name'])];

	$uploadedImages = [];

	foreach(['recipe_image'] as $image_key) {

		if($image[$image_key]) {

			$file_name = $_FILES[$image_key]['name'];
			$file_size = $_FILES[$image_key]['size'];
			$file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$file_temp = $_FILES[$image_key]['tmp_name'];

			if (!in_array($file_extension, allowedFileExt())) {

				$errors[] = "<b>".$image_key."</b> " . _ERRORALLOWEDFILEFORMATS;  
	
			} else if ($file_size > allowedFileSize()) {
	
				$errors[] = "<b>".$image_key."</b> " . _ERRORFILETOOLARGE;  
	
			}

			if(empty($errors)){

				$image_new_name = md5(time()) . '.' . $file_extension;
				move_uploaded_file($file_temp, $target_dir . $image_new_name);
				$uploadedImages += [$image_key => $image_new_name];

			}
		}
	}

	if(empty($errors)){

		$statment = connect()->prepare("INSERT INTO recipes (
			recipe_author,
			recipe_title,
			recipe_description,
			recipe_status,
			recipe_ingredients,
			recipe_steps,
			recipe_categories,
			recipe_availability,
			recipe_image) VALUES (
			:recipe_author,
			:recipe_title,
			:recipe_description,
			:recipe_status,
			:recipe_ingredients,
			:recipe_steps,
			:recipe_categories,
			:recipe_availability,
			:recipe_image)");

		$statment->execute(array(
			':recipe_author' => $memberInfo['member_id'],
			':recipe_title' => $recipe_title,
			':recipe_description' => $recipe_description,
			':recipe_status' => $recipe_status,
			':recipe_ingredients' => $recipe_ingredients,
			':recipe_steps' => $recipe_steps,
			':recipe_categories' => (isset($_POST['recipe_categories']) && !empty($_POST['recipe_categories']) ? json_encode($_POST['recipe_categories']) : ""),
			':recipe_availability' => $recipe_availability,
			':recipe_image' => $uploadedImages['recipe_image']
		));
	
		header('Location: ./recipes.php');
	}
}

$categories = get_all_categories();

require '../views/new.recipe.view.php';

}else{

header('Location: ./denied.php');

}

}else{

header('Location:'.SITE_URL);

}


?>