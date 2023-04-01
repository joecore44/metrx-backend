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

if(check_permission('create_trainers')){

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$trainer_member = cleardata($_POST['trainer_member']);
	$trainer_name = cleardata($_POST['trainer_name']);
	$trainer_description = cleardata($_POST['trainer_description']);

	$required_fields = ['trainer_member', 'trainer_name'];
	foreach($required_fields as $field) {
		if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
				$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
		}
	}

	$statement = connect()->prepare("SELECT trainers.*, members.* FROM trainers LEFT JOIN members ON members.member_id = trainers.trainer_member WHERE trainer_member = :trainer_member LIMIT 1");
	$statement->execute(array(':trainer_member' => $trainer_member));
	$result = $statement->fetch();

	if ($result != false) {
		
		$errors[] = "<b>".$result['member_email']."</b> " . _ERRORALREADYEXIST;  
	
	}
	
	$image = [
		'trainer_avatar' => isset($_FILES['trainer_avatar']['name']) && !empty($_FILES['trainer_avatar']['name'])
	];

	$uploadedImages = [];

	foreach(['trainer_avatar'] as $image_key) {

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

	$statment = connect()->prepare("INSERT INTO trainers (trainer_id, trainer_name, trainer_member, trainer_description, trainer_avatar) VALUES (null, :trainer_name, :trainer_member, :trainer_description, :trainer_avatar)");

	$statment->execute(array(
		':trainer_name' => $trainer_name,
		':trainer_member' => $trainer_member,
		':trainer_description' => $trainer_description,
		':trainer_avatar' => $uploadedImages['trainer_avatar']
	));

	header('Location: ./trainers.php');
}

}

$members = get_all_members();

require '../views/new.trainer.view.php';

}else{
	
	header('Location: ./denied.php');
}

}else {

	header('Location:'.SITE_URL);

}

?>