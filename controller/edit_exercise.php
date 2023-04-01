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

$id_exercise = cleardata(getId());

if(!$id_exercise){
	header('Location: home.php');
}

if(check_permission('view_exercises') || check_permission('edit_exercises')){

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(check_permission('edit_exercises')){

	$exercise_id = cleardata($_POST['exercise_id']);
	$exercise_title = cleardata($_POST['exercise_title']);
	$exercise_description = cleardata($_POST['exercise_description']);
	$exercise_time = cleardata($_POST['exercise_time']);
	$exercise_type = cleardata($_POST['exercise_type']);
	$exercise_reps = cleardata($_POST['exercise_reps']);
	$exercise_sets = cleardata($_POST['exercise_sets']);
	$exercise_rest = cleardata($_POST['exercise_rest']);
	$exercise_video = cleardata($_POST['exercise_video']);
	$exercise_status = cleardata($_POST['exercise_status']);
	$exercise_instructions = cleardata($_POST['exercise_instructions']);
	$exercise_bodyparts = json_encode((isset($_POST['exercise_bodyparts']) && !empty($_POST['exercise_bodyparts']) ? $_POST['exercise_bodyparts'] : []));
	$exercise_equipments = json_encode((isset($_POST['exercise_equipments']) && !empty($_POST['exercise_equipments']) ? $_POST['exercise_equipments'] : []));
	$exercise_levels = json_encode((isset($_POST['exercise_levels']) && !empty($_POST['exercise_levels']) ? $_POST['exercise_levels'] : []));

	$required_fields = ['exercise_title', 'exercise_video'];
	foreach($required_fields as $field) {
		if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
				$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
		}
	}
	
	$image = ['exercise_image' => isset($_FILES['exercise_image']['name']) && !empty($_FILES['exercise_image']['name'])];

	$uploadedImages = [];

	foreach(['exercise_image'] as $image_key) {

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

	$statment = connect()->prepare("UPDATE exercises SET
	exercise_title = :exercise_title,
	exercise_description = :exercise_description,
	exercise_time = :exercise_time,
	exercise_type = :exercise_type,
	exercise_reps = :exercise_reps,
	exercise_sets = :exercise_sets,
	exercise_rest = :exercise_rest,
	exercise_video = :exercise_video,
	exercise_status = :exercise_status,
	exercise_bodyparts = :exercise_bodyparts,
	exercise_equipments = :exercise_equipments,
	exercise_levels = :exercise_levels,
	exercise_instructions = :exercise_instructions,
	exercise_image = :exercise_image
	WHERE exercise_id = :exercise_id");

	$statment->execute(array(
	':exercise_id' => $exercise_id,
	':exercise_title' => $exercise_title,
	':exercise_description' => $exercise_description,
	':exercise_time' => $exercise_time,
	':exercise_type' => $exercise_type,
	':exercise_reps' => $exercise_reps,
	':exercise_sets' => $exercise_sets,
	':exercise_rest' => $exercise_rest,
	':exercise_video' => $exercise_video,
	':exercise_status' => $exercise_status,
	':exercise_bodyparts' => (isset($_POST['exercise_bodyparts']) && !empty($_POST['exercise_bodyparts']) ? $exercise_bodyparts : ""),
	':exercise_equipments' => (isset($_POST['exercise_equipments']) && !empty($_POST['exercise_equipments']) ? $exercise_equipments : ""),
	':exercise_levels' => (isset($_POST['exercise_levels']) && !empty($_POST['exercise_levels']) ? $exercise_levels : ""),
	':exercise_instructions' => $exercise_instructions,
	':exercise_image' => (isset($uploadedImages['exercise_image']) ? $uploadedImages['exercise_image'] : $_POST['exercise_image_save'])
	));

	header('Location: ' . $_SERVER['HTTP_REFERER']);

}
		
}else{

header('Location: ./denied.php');		

}

}

$exerciseDetails = get_exercise_per_id($id_exercise);

if(!$exerciseDetails){
	header('Location: home.php');
}

$levels = get_all_levels();
$equipments = get_all_equipments();
$bodyparts = get_all_bodyparts();
$siteSettings = get_settings();

require '../views/edit.exercise.view.php';

}else{

header('Location: ./denied.php');		

}

}else{

header('Location:'.SITE_URL);

}

?>