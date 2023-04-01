<?php 

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require '../config.php';
require '../functions.php';

if(check_session() == true){
    
$id_item = cleardata(getId());

if(!$id_item){
	exit();
}

if(check_permission('delete_recipes')){

	$statement = connect()->prepare("DELETE FROM recipes WHERE recipe_id = :recipe_id");
	$statement->execute(array('recipe_id' => $id_item));

	header('Location: ' . $_SERVER['HTTP_REFERER']);

}else{

	echo "access_denied";
}

}else{
	
	exit();		
}

?>