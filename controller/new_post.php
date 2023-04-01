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

if(check_permission('create_posts')){

$memberInfo = get_member_information();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$post_title = cleardata($_POST['post_title']);
	$post_description = cleardata($_POST['post_description']);
	$post_status = cleardata($_POST['post_status']);
	$post_availability = cleardata($_POST['post_availability']);
	$post_tags = (isset($_POST['post_tags']) && !empty($_POST['post_tags']) ? json_encode($_POST['post_tags']) : "");

	$required_fields = ['post_title'];
	foreach($required_fields as $field) {
		if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
				$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
		}
	}
	
	$image = ['post_image' => isset($_FILES['post_image']['name']) && !empty($_FILES['post_image']['name'])];

	$uploadedImages = [];

	foreach(['post_image'] as $image_key) {

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

		$statment = connect()->prepare("INSERT INTO posts (
			post_author,
			post_title,
			post_description,
			post_status,
			post_tags,
			post_availability,
			post_image) VALUES (
			:post_author,
			:post_title,
			:post_description,
			:post_status,
			:post_tags,
			:post_availability,
			:post_image)");

		$statment->execute(array(
			':post_author' => $memberInfo['member_id'],
			':post_title' => $post_title,
			':post_description' => $post_description,
			':post_status' => $post_status,
			':post_tags' => (isset($_POST['post_tags']) && !empty($_POST['post_tags']) ? json_encode($post_tags) : ""),
			':post_availability' => $post_availability,
			':post_image' => $uploadedImages['post_image']
		));
	
		header('Location: ./posts.php');
	}
}

$tags = get_all_tags();

require '../views/new.post.view.php';

}else{

header('Location: ./denied.php');

}

}else{

header('Location:'.SITE_URL);

}


?>