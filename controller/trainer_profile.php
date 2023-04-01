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

$memberInfo = get_member_information();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$trainer_id = cleardata($_POST['trainer_id']);
	$trainer_name = cleardata($_POST['trainer_name']);
	$trainer_description = cleardata($_POST['trainer_description']);
	$trainer_status = cleardata($_POST['trainer_status']);
	$trainer_member = cleardata($_POST['trainer_member']);

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

		$statment = connect()->prepare("UPDATE trainers SET trainer_id = :trainer_id, trainer_name = :trainer_name, trainer_description = :trainer_description, trainer_status = :trainer_status, trainer_member = :trainer_member WHERE trainer_id = :trainer_id");
	
		$statment->execute(array(
			':trainer_id' => $trainer_id,
			':trainer_name' => $trainer_name,
			':trainer_description' => $trainer_description,
			':trainer_status' => $trainer_status,
			':trainer_member' => $trainer_member,
			':trainer_avatar' => (isset($uploadedImages['trainer_avatar']) ? $uploadedImages['trainer_avatar'] : $_POST['trainer_avatar_save'])
		));
	
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	
	}

}

	$trainer = get_trainer_per_member_id($memberInfo['member_id']);

	if(!$trainer){
		header('Location: ./home.php');
	}

	$members = get_all_members();

	require '../views/trainer-profile.view.php';

}else{
	header('Location:'.SITE_URL);
}


?>