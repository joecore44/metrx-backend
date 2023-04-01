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

	$id_level = cleardata(getId());

	if(!$id_level){
		header('Location: home.php');
	}

	if(check_permission('view_levels') || check_permission('edit_levels')){

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
		if(check_permission('edit_levels')){

			$level_id = cleardata($_POST['level_id']);
			$level_title = cleardata($_POST['level_title']);
			$level_status = cleardata($_POST['level_status']);

			$required_fields = ['level_title'];
			foreach($required_fields as $field) {
				if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
					$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
				}
			}
			
			$image = ['level_image' => isset($_FILES['level_image']['name']) && !empty($_FILES['level_image']['name'])];
		
			$uploadedImages = [];
		
			foreach(['level_image'] as $image_key) {
		
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

			$statment = connect()->prepare("UPDATE levels SET level_id = :level_id, level_title = :level_title, level_status = :level_status, level_image = :level_image WHERE level_id = :level_id");

			$statment->execute(array(
				':level_id' => $level_id,
				':level_title' => $level_title,
				':level_status' => $level_status,
				':level_image' => (isset($uploadedImages['level_image']) ? $uploadedImages['level_image'] : $_POST['level_image_save'])
			));

			header('Location: ' . $_SERVER['HTTP_REFERER']);

		}

		}else{
	
			header('Location: ./denied.php');		
	
		}
		
		}

		$level = get_level_per_id($id_level);

		if (!$level){

			header('Location: ./home.php');
		}

		require '../views/edit.level.view.php';
		
}else{

	header('Location: ./denied.php');		

}

}else {
	header('Location:'.SITE_URL);
}

?>