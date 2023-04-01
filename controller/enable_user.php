<?php 

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require '../config.php';
require '../functions.php';

if(check_session() == true){
    
$id_user = cleardata(getId());

if(!$id_user){
	exit();
}

if(check_permission('edit_users') || check_permission('delete_users')){

	$auth = $factory->createAuth();

	try {
		$updatedUser = $auth->enableUser($id_user);
	}catch (PDOException $e){
		//echo $e->getMessage();
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);

}else{
	
	echo "access_denied";
}

}else{
	
	exit();		
}

?>