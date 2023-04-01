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

$id_user = cleardata(getId());

if(!$id_user){
	header('Location: home.php');
}

$auth = $factory->createAuth();

if(check_permission('view_users') || check_permission('edit_users')){

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(check_permission('edit_users')){

		$user_id = cleardata($_POST['user_id']);
		$user_name = cleardata($_POST['user_name']);
		$user_email = cleardata($_POST['user_email']);

		$password = $_POST['user_password'];
		$password_save = $_POST['user_password_save'];
	
		if(empty($password)) {
			$password = $password_save;
		}else{
			$password = $password;
		}
	
		$required_fields = ['user_id', 'user_name', 'user_email'];
		foreach($required_fields as $field) {
			if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
					$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
			}
		}
	
		if(empty($errors)){

		$userProperties = [
			'email' => $user_email,
			'password' => $password,
			'displayName' => $user_name
		];
		
		$updateUser = $auth->updateUser($user_id, $userProperties);
	
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	
	}

}else{

	header('Location: ./denied.php');		

}

}

	$user = $auth->getUser($id_user);

	if(!$user){
		header('Location: ./home.php');
	}

	require '../views/edit.user.view.php';
		
}else{

	header('Location: ./denied.php');		
}

}else{
	header('Location:'.SITE_URL);
}


?>