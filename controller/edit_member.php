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

$id_member = cleardata(getId());

if(!$id_member){
	header('Location: home.php');
}

if(check_permission('view_members') || check_permission('edit_members')){

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(check_permission('edit_members')){

	$member_id = cleardata($_POST['member_id']);
	$member_name = cleardata($_POST['member_name']);
	$member_email = cleardata($_POST['member_email']);
	$member_role = cleardata($_POST['member_role']);
	$member_status = cleardata($_POST['member_status']);
	$password = $_POST['member_password'];
	$password_save = $_POST['member_password_save'];

	if(empty($password)) {
		$password = $password_save;
	}else{
		$password = hash('sha512', $password);
	}

	$required_fields = ['member_name', 'member_email', 'member_role'];
	foreach($required_fields as $field) {
		if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
				$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
		}
	}

	if(empty($errors)){

	$statment = connect()->prepare("UPDATE members SET member_id = :member_id, member_name = :member_name, member_email = :member_email, member_role = :member_role, member_status = :member_status, member_password = :member_password WHERE member_id = :member_id");

	$statment->execute(array(
		':member_id' => $member_id,
		':member_name' => $member_name,
		':member_email' => $member_email,
		':member_role' => $member_role,
		':member_status' => $member_status,
		':member_password' => $password
	));

	header('Location: ' . $_SERVER['HTTP_REFERER']);

}

}else{

	header('Location: ./denied.php');		

}

}

	$member = get_member_per_id($id_member);

	if(!$member){
		header('Location: ./home.php');
	}

	$roles = get_all_roles();

	require '../views/edit.member.view.php';
		
}else{

	header('Location: ./denied.php');		
}

}else{
	header('Location:'.SITE_URL);
}


?>