<?php 

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require '../config.php';
require '../functions.php';

if(check_session() == true){

$id_workout = cleardata(getId());

if(!$id_workout){
	exit();
}

if(check_permission('delete_workouts')){

	$statement = connect()->prepare("DELETE FROM workouts WHERE workout_id = :workout_id");
	$statement->execute(array('workout_id' => $id_workout));

	header('Location: ' . $_SERVER['HTTP_REFERER']);
	
}else{
	
	echo "access_denied";
}

}else{
	
	exit();		
}

?>