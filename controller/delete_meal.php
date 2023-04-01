<?php 

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require '../config.php';
require '../functions.php';

if(check_session() == true){

$id_meal = cleardata(getId());

if(!$id_meal){
	exit();
}

if(check_permission('delete_meals')){

	$statement = connect()->prepare("DELETE FROM meals WHERE meal_id = :meal_id");
	$statement->execute(array('meal_id' => $id_meal));

	header('Location: ' . $_SERVER['HTTP_REFERER']);
	
}else{
	
	echo "access_denied";
}

}else{
	
	exit();		
}

?>