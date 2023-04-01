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

	$id_bodypart = cleardata(getId());

	if(!$id_bodypart){
		header('Location: home.php');
	}

	if(check_permission('view_bodyparts') || check_permission('edit_bodyparts')){

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
		if(check_permission('edit_bodyparts')){

			$bodypart_id = cleardata($_POST['bodypart_id']);
			$bodypart_title = cleardata($_POST['bodypart_title']);
			$bodypart_status = cleardata($_POST['bodypart_status']);

			$required_fields = ['bodypart_title'];
			foreach($required_fields as $field) {
				if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
					$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
				}
			}
			
			$image = ['bodypart_image' => isset($_FILES['bodypart_image']['name']) && !empty($_FILES['bodypart_image']['name'])];
		
			$uploadedImages = [];
		
			foreach(['bodypart_image'] as $image_key) {
		
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

			$statment = connect()->prepare("UPDATE bodyparts SET bodypart_id = :bodypart_id, bodypart_title = :bodypart_title, bodypart_status = :bodypart_status, bodypart_image = :bodypart_image WHERE bodypart_id = :bodypart_id");

			$statment->execute(array(
				':bodypart_id' => $bodypart_id,
				':bodypart_title' => $bodypart_title,
				':bodypart_status' => $bodypart_status,
				':bodypart_image' => (isset($uploadedImages['bodypart_image']) ? $uploadedImages['bodypart_image'] : $_POST['bodypart_image_save'])
			));

			header('Location: ' . $_SERVER['HTTP_REFERER']);

		}

		}else{
	
			header('Location: ./denied.php');		
	
		}
		
		}

		$bodypart = get_bodypart_per_id($id_bodypart);

		if (!$bodypart){

			header('Location: ./home.php');
		}

		require '../views/edit.bodypart.view.php';
		
}else{

	header('Location: ./denied.php');		

}

}else {
	header('Location:'.SITE_URL);
}

?>