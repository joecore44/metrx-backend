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

if(check_permission('create_tags')){

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$tag_title = cleardata($_POST['tag_title']);
	$tag_status = cleardata($_POST['tag_status']);

	$required_fields = ['tag_title'];
	foreach($required_fields as $field) {
		if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
				$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
		}
	}
	
	if(empty($errors)){

	$statment = connect()->prepare("INSERT INTO tags (tag_id, tag_title, tag_status) VALUES (null, :tag_title, :tag_status)");

	$statment->execute(array(
		':tag_title' => $tag_title,
		':tag_status' => $tag_status
	));

	header('Location: ./tags.php');

}

}

require '../views/new.tag.view.php';

}else{
	
	header('Location: ./denied.php');
}

}else {

	header('Location:'.SITE_URL);

}

?>