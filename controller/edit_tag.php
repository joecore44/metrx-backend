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

	$id_tag = cleardata(getId());

	if(!$id_tag){
		header('Location: home.php');
	}

	if(check_permission('view_tags') || check_permission('edit_tags')){

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
		if(check_permission('edit_tags')){

			$tag_id = cleardata($_POST['tag_id']);
			$tag_title = cleardata($_POST['tag_title']);
			$tag_status = cleardata($_POST['tag_status']);

			$required_fields = ['tag_title'];
			foreach($required_fields as $field) {
				if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
					$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
				}
			}
			
			if(empty($errors)){

			$statment = connect()->prepare("UPDATE tags SET tag_id = :tag_id, tag_title = :tag_title, tag_status = :tag_status WHERE tag_id = :tag_id");

			$statment->execute(array(
				':tag_id' => $tag_id,
				':tag_title' => $tag_title,
				':tag_status' => $tag_status
			));

			header('Location: ' . $_SERVER['HTTP_REFERER']);

		}

		}else{
	
			header('Location: ./denied.php');		
	
		}
		
		}

		$tag = get_tag_per_id($id_tag);

		if (!$tag){

			header('Location: ./home.php');
		}

		require '../views/edit.tag.view.php';
		
}else{

	header('Location: ./denied.php');		

}

}else {
	header('Location:'.SITE_URL);
}

?>