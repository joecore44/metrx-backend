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

if(check_permission('create_users')){

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$auth = $factory->createAuth();

	$user_name = cleardata($_POST['user_name']);
	$user_email = cleardata($_POST['user_email']);
	$user_password = cleardata($_POST['user_password']);

	$required_fields = ['user_name', 'user_email', 'user_password'];
	foreach($required_fields as $field) {
		if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
				$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
		}
	}

	try{        
            
	$user_exist = $auth->getUserByEmail($user_email);

	if($user_exist){
		$errors[] = "<b>".$user_email."</b> " . _ERRORALREADYEXIST;  
	}
            
	}catch (PDOException $e){

		// $errors[] = $e->getMessage();   
	}

	if(empty($errors)){

	$userProperties = [
		'email' => $user_email,
		'password' => $user_password,
		'displayName' => $user_name
	];
	
	$createdUser = $auth->createUser($userProperties);

	header('Location: ./users.php');
}

}

require '../views/new.user.view.php';

}else{

header('Location: ./denied.php');
}

}else{

header('Location:'.SITE_URL);
}

?>