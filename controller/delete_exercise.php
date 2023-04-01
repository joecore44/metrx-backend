<?php 

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require '../config.php';
require '../functions.php';

if(check_session() == true){

$id_exercise = cleardata(getId());

if(!$id_exercise){
	exit();
}

if(check_permission('delete_exercises')){

	$statement = connect()->prepare("DELETE FROM exercises WHERE exercise_id = :exercise_id");
	$statement->execute(array('exercise_id' => $id_exercise));

	header('Location: ' . $_SERVER['HTTP_REFERER']);
	
}else{
	
	echo "access_denied";
}

}else{
	
	exit();		
}

?>