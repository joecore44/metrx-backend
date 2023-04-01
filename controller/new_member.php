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

if(check_permission('create_members')){

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$member_name = cleardata($_POST['member_name']);
	$member_email = cleardata($_POST['member_email']);
	$member_password = cleardata($_POST['member_password']);
	$encryptPass = hash('sha512', $member_password);
	$member_role = cleardata($_POST['member_role']);

	$required_fields = ['member_name', 'member_email', 'member_password', 'member_role'];
	foreach($required_fields as $field) {
		if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
				$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
		}
	}

	$statement = connect()->prepare("SELECT * FROM members WHERE member_email = :member_email LIMIT 1");
	$statement->execute(array(':member_email' => $member_email));
	$result = $statement->fetch();

	if ($result != false) {
		
		$errors[] = "<b>".$result['member_email']."</b> " . _ERRORALREADYEXIST;  
	
	}

	if(empty($errors)){

	$statment = connect()->prepare("INSERT INTO members (member_id, member_name, member_email, member_password, member_role) VALUES (null, :member_name, :member_email, :member_password, :member_role)");

	$statment->execute(array(
		':member_name' => $member_name,
		':member_email' => $member_email,
		':member_password' => $encryptPass,
		':member_role' => $member_role
	));

	header('Location: ./members.php');
}

}

$roles = get_all_roles();

require '../views/new.member.view.php';

}else{

header('Location: ./denied.php');
}

}else{

header('Location:'.SITE_URL);
}

?>