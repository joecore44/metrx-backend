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

	$id_equipment = cleardata(getId());

	if(!$id_equipment){
		header('Location: home.php');
	}

	if(check_permission('view_equipments') || check_permission('edit_equipments')){

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
		if(check_permission('edit_equipments')){

			$equipment_id = cleardata($_POST['equipment_id']);
			$equipment_title = cleardata($_POST['equipment_title']);
			$equipment_status = cleardata($_POST['equipment_status']);

			$required_fields = ['equipment_title'];
			foreach($required_fields as $field) {
				if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
					$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
				}
			}
			
			$image = ['equipment_image' => isset($_FILES['equipment_image']['name']) && !empty($_FILES['equipment_image']['name'])];
		
			$uploadedImages = [];
		
			foreach(['equipment_image'] as $image_key) {
		
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

			$statment = connect()->prepare("UPDATE equipments SET equipment_id = :equipment_id, equipment_title = :equipment_title, equipment_status = :equipment_status, equipment_image = :equipment_image WHERE equipment_id = :equipment_id");

			$statment->execute(array(
				':equipment_id' => $equipment_id,
				':equipment_title' => $equipment_title,
				':equipment_status' => $equipment_status,
				':equipment_image' => (isset($uploadedImages['equipment_image']) ? $uploadedImages['equipment_image'] : $_POST['equipment_image_save'])
			));

			header('Location: ' . $_SERVER['HTTP_REFERER']);

		}

		}else{
	
			header('Location: ./denied.php');		
	
		}
		
		}

		$equipment = get_equipment_per_id($id_equipment);

		if (!$equipment){

			header('Location: ./home.php');
		}

		require '../views/edit.equipment.view.php';
		
}else{

	header('Location: ./denied.php');		

}

}else {
	header('Location:'.SITE_URL);
}

?>