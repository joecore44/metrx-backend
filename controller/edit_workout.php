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

$id_workout = cleardata(getId());

if(!$id_workout){
	header('Location: home.php');
}

if(check_permission('view_workouts') || check_permission('edit_workouts')){

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(check_permission('edit_workouts')){

	$workout_id = cleardata($_POST['workout_id']);
	$workout_title = cleardata($_POST['workout_title']);
	$workout_description = cleardata($_POST['workout_description']);
	$workout_type = cleardata($_POST['workout_type']);
	$workout_trainer = cleardata($_POST['workout_trainer']);
	$workout_status = cleardata($_POST['workout_status']);
	$workout_availability = cleardata($_POST['workout_availability']);
	$workout_rate = cleardata($_POST['workout_rate']);
	$workout_exercises = cleardata($_POST['workout_exercises']);
	$workout_bodyparts = json_encode((isset($_POST['workout_bodyparts']) && !empty($_POST['workout_bodyparts']) ? $_POST['workout_bodyparts'] : []));
	$workout_equipments = json_encode((isset($_POST['workout_equipments']) && !empty($_POST['workout_equipments']) ? $_POST['workout_equipments'] : []));
	$workout_levels = json_encode((isset($_POST['workout_levels']) && !empty($_POST['workout_levels']) ? $_POST['workout_levels'] : []));
	$workout_goals = json_encode((isset($_POST['workout_goals']) && !empty($_POST['workout_goals']) ? $_POST['workout_goals'] : []));

	$required_fields = ['workout_title'];
	foreach($required_fields as $field) {
		if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
				$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
		}
	}
	
	$image = ['workout_image' => isset($_FILES['workout_image']['name']) && !empty($_FILES['workout_image']['name'])];

	$uploadedImages = [];

	foreach(['workout_image'] as $image_key) {

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

	$statment = connect()->prepare("UPDATE workouts SET
	workout_title = :workout_title,
	workout_description = :workout_description,
	workout_type = :workout_type,
	workout_trainer = :workout_trainer,
	workout_status = :workout_status,
	workout_availability = :workout_availability,
	workout_rate = :workout_rate,
	workout_bodyparts = :workout_bodyparts,
	workout_equipments = :workout_equipments,
	workout_levels = :workout_levels,
	workout_exercises = :workout_exercises,
	workout_goals = :workout_goals,
	workout_image = :workout_image
	WHERE workout_id = :workout_id");

	$statment->execute(array(
	':workout_id' => $workout_id,
	':workout_title' => $workout_title,
	':workout_description' => $workout_description,
	':workout_type' => $workout_type,
	':workout_trainer' => $workout_trainer,
	':workout_status' => $workout_status,
	':workout_availability' => $workout_availability,
	':workout_rate' => $workout_rate,
	':workout_bodyparts' => (isset($_POST['workout_bodyparts']) && !empty($_POST['workout_bodyparts']) ? $workout_bodyparts : ""),
	':workout_equipments' => (isset($_POST['workout_equipments']) && !empty($_POST['workout_equipments']) ? $workout_equipments : ""),
	':workout_levels' => (isset($_POST['workout_levels']) && !empty($_POST['workout_levels']) ? $workout_levels : ""),
	':workout_goals' => (isset($_POST['workout_goals']) && !empty($_POST['workout_goals']) ? $workout_goals : ""),
	':workout_exercises' => $workout_exercises,
	':workout_image' => (isset($uploadedImages['workout_image']) ? $uploadedImages['workout_image'] : $_POST['workout_image_save'])
	));

	header('Location: ' . $_SERVER['HTTP_REFERER']);

}
		
}else{

header('Location: ./denied.php');		

}

}

$workoutDetails = get_workout_per_id($id_workout);

if(!$workoutDetails){
	header('Location: home.php');
}

$trainers = get_all_trainers();
$levels = get_all_levels();
$equipments = get_all_equipments();
$goals = get_all_goals();
$bodyparts = get_all_bodyparts();
$exercises = get_all_exercises();
$siteSettings = get_settings();

require '../views/edit.workout.view.php';

}else{

header('Location: ./denied.php');		

}

}else{

header('Location:'.SITE_URL);

}

?>