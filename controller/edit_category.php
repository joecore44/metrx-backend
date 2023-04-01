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

	$id_category = cleardata(getId());

	if(!$id_category){
		header('Location: home.php');
	}

	if(check_permission('view_categories') || check_permission('edit_categories')){

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
		if(check_permission('edit_categories')){

			$category_id = cleardata($_POST['category_id']);
			$category_title = cleardata($_POST['category_title']);
			$category_status = cleardata($_POST['category_status']);

			$required_fields = ['category_title'];
			foreach($required_fields as $field) {
				if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
					$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
				}
			}
			
			$image = ['category_image' => isset($_FILES['category_image']['name']) && !empty($_FILES['category_image']['name'])];
		
			$uploadedImages = [];
		
			foreach(['category_image'] as $image_key) {
		
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

			$statment = connect()->prepare("UPDATE categories SET category_id = :category_id, category_title = :category_title, category_status = :category_status, category_image = :category_image WHERE category_id = :category_id");

			$statment->execute(array(
				':category_id' => $category_id,
				':category_title' => $category_title,
				':category_status' => $category_status,
				':category_image' => (isset($uploadedImages['category_image']) ? $uploadedImages['category_image'] : $_POST['category_image_save'])
			));

			header('Location: ' . $_SERVER['HTTP_REFERER']);

		}

		}else{
	
			header('Location: ./denied.php');		
	
		}
		
		}

		$category = get_category_per_id($id_category);

		if (!$category){

			header('Location: ./home.php');
		}

		require '../views/edit.category.view.php';
		
}else{

	header('Location: ./denied.php');		

}

}else {
	header('Location:'.SITE_URL);
}

?>