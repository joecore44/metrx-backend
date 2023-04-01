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

if(check_permission('create_goals')){

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$goal_title = cleardata($_POST['goal_title']);
	$goal_status = cleardata($_POST['goal_status']);

	$required_fields = ['goal_title'];
	foreach($required_fields as $field) {
		if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
				$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
		}
	}
	
	$image = [
		'goal_image' => isset($_FILES['goal_image']['name']) && !empty($_FILES['goal_image']['name'])
	];

	$uploadedImages = [];

	foreach(['goal_image'] as $image_key) {

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

				$image_new_name = md5(time() . rand()) . '.' . $file_extension;
				move_uploaded_file($file_temp, $target_dir . $image_new_name);
				$uploadedImages += [$image_key => $image_new_name];

			}

		}

	}

	if(empty($errors)){

	$statment = connect()->prepare("INSERT INTO goals (goal_id, goal_title, goal_status, goal_image) VALUES (null, :goal_title, :goal_status, :goal_image)");

	$statment->execute(array(
		':goal_title' => $goal_title,
		':goal_status' => $goal_status,
		':goal_image' => $uploadedImages['goal_image']
	));

	header('Location: ./goals.php');

}

}

require '../views/new.goal.view.php';

}else{
	
	header('Location: ./denied.php');
}

}else {

	header('Location:'.SITE_URL);

}

?>