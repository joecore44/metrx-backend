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

	$id_goal = cleardata(getId());

	if(!$id_goal){
		header('Location: home.php');
	}

	if(check_permission('view_goals') || check_permission('edit_goals')){

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
		if(check_permission('edit_goals')){

			$goal_id = cleardata($_POST['goal_id']);
			$goal_title = cleardata($_POST['goal_title']);
			$goal_status = cleardata($_POST['goal_status']);

			$required_fields = ['goal_title'];
			foreach($required_fields as $field) {
				if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
					$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
				}
			}
			
			$image = ['goal_image' => isset($_FILES['goal_image']['name']) && !empty($_FILES['goal_image']['name'])];
		
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

			$statment = connect()->prepare("UPDATE goals SET goal_id = :goal_id, goal_title = :goal_title, goal_status = :goal_status, goal_image = :goal_image WHERE goal_id = :goal_id");

			$statment->execute(array(
				':goal_id' => $goal_id,
				':goal_title' => $goal_title,
				':goal_status' => $goal_status,
				':goal_image' => (isset($uploadedImages['goal_image']) ? $uploadedImages['goal_image'] : $_POST['goal_image_save'])
			));

			header('Location: ' . $_SERVER['HTTP_REFERER']);

		}

		}else{
	
			header('Location: ./denied.php');		
	
		}
		
		}

		$goal = get_goal_per_id($id_goal);

		if (!$goal){

			header('Location: ./home.php');
		}

		require '../views/edit.goal.view.php';
		
}else{

	header('Location: ./denied.php');		

}

}else {
	header('Location:'.SITE_URL);
}

?>