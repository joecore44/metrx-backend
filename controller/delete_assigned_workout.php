<?php 

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require '../config.php';
require '../functions.php';

if(check_session() == true){

$id = cleardata(getId());

if(!$id){
	exit();
}

if(check_permission('delete_workouts')){

	$statement = connect()->prepare("DELETE FROM workouts_users WHERE id = :id");
	$statement->execute(array('id' => $id));

	header('Location: ' . $_SERVER['HTTP_REFERER']);
	
}else{
	
	echo "access_denied";
}

}else{
	
	exit();		
}

?>