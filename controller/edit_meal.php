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

$id_meal = cleardata(getId());

if(!$id_meal){
	header('Location: home.php');
}

if(check_permission('view_meals') || check_permission('edit_meals')){

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(check_permission('edit_meals')){

	$meal_id = cleardata($_POST['meal_id']);
	$meal_title = cleardata($_POST['meal_title']);
	$meal_description = cleardata($_POST['meal_description']);
	$meal_featured = cleardata($_POST['meal_featured']);
	$meal_trainer = cleardata($_POST['meal_trainer']);
	$meal_status = cleardata($_POST['meal_status']);
	$meal_availability = cleardata($_POST['meal_availability']);
	$meal_calories = cleardata($_POST['meal_calories']);
	$meal_days = cleardata($_POST['meal_days']);
	$meal_categories = json_encode($_POST['meal_categories']);

	$required_fields = ['meal_title'];
	foreach($required_fields as $field) {
		if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
				$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
		}
	}
	
	$image = ['meal_image' => isset($_FILES['meal_image']['name']) && !empty($_FILES['meal_image']['name'])];

	$uploadedImages = [];

	foreach(['meal_image'] as $image_key) {

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

	$statment = connect()->prepare("UPDATE meals SET
	meal_title = :meal_title,
	meal_description = :meal_description,
	meal_featured = :meal_featured,
	meal_trainer = :meal_trainer,
	meal_status = :meal_status,
	meal_categories = :meal_categories,
	meal_days = :meal_days,
	meal_availability = :meal_availability,
	meal_calories = :meal_calories,
	meal_image = :meal_image
	WHERE meal_id = :meal_id");

	$statment->execute(array(
	':meal_id' => $meal_id,
	':meal_title' => $meal_title,
	':meal_description' => $meal_description,
	':meal_featured' => $meal_featured,
	':meal_trainer' => $meal_trainer,
	':meal_status' => $meal_status,
	':meal_categories' => (isset($_POST['meal_categories']) && !empty($_POST['meal_categories']) ? $meal_categories : ""),
	':meal_days' => $meal_days,
	':meal_availability' => $meal_availability,
	':meal_calories' => $meal_calories,
	':meal_image' => (isset($uploadedImages['meal_image']) ? $uploadedImages['meal_image'] : $_POST['meal_image_save'])
	));

	header('Location: ' . $_SERVER['HTTP_REFERER']);

}
		
}else{

header('Location: ./denied.php');		

}

}

$mealDetails = get_meal_per_id($id_meal);

if(!$mealDetails){
	header('Location: home.php');
}

$trainers = get_all_trainers();
$categories = get_all_categories();
$recipes = get_all_recipes();
$siteSettings = get_settings();

require '../views/edit.meal.view.php';

}else{

header('Location: ./denied.php');		

}

}else{

header('Location:'.SITE_URL);

}

?>